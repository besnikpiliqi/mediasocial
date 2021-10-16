<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //model::search(['name','username', 'email'], $request->get('searche') )
        Builder::macro('search',function($attributes,string $searchTerm){
            // $searchTerm = str_replace(' ','%', $searchTerm);
            $this->where(function(Builder $query) use ($attributes,$searchTerm){
                foreach(array_values($attributes) as $attribute){
                    $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
            });
            return $this;
        });
        //model::search(['name','username', 'email'], $request->get('searche') )
        // kjo kur kerkon me hapsir ne input psh me emer dhe mbiemer por e shkrun psh bes pili ose pili be dhe e gjen komplet
        // por kjo nuk ban kombinim me kerku nje pjes ne name dhe tjetren ne email dmth kur perzihen te dyjat nuk qet kurgjo
        // kjo ban njejt si ajo nalt search por vetem qe kjo ka me shum opsione
        // dmth ajo nalt search nuk gjen rezultat me germa te ndame por vetem te ngjita
        Builder::macro('searchTwo',function($attributes,string $searchTerms){
            $this->where(function(Builder $query) use ($attributes,$searchTerms){
                foreach(array_values($attributes) as $attribute){
                   $query->orWhere(function($query) use ($attribute, $searchTerms){
                        foreach(explode(' ', $searchTerms) as $searchTerm){
                            $query->where($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                   });
                }
            });
            return $this;
        });
        // Post::whereLikeWith(['user.name','user.username', 'comments.content'], $request->get('searche') )->get();
        // me relatione
        // kjo i merr krejt postimet sipas emrit username email qe shkruhet en input dmth i gjen postimet e personit qe kerkohet
        // kjo merr edhe tjera sene ne baz nevojes
        Builder::macro('whereLikeWith', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (array_values($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
        
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });
        
            return $this;
        });

        // model User::whereLikeName(['name','username', 'email'], ['bes','lid'] )
        // kjo eshte per mi gjet krejt users me emrat e shkrum ne input te ndame me hapsira
        Builder::macro('whereLikeName',function($attributes,$searchTerms){
            $this->where(function($query) use ($attributes,$searchTerms){
                foreach(array_values($attributes) as $attribute){
                    foreach(array_values($searchTerms) as $searchTerm){
                        $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                    }
                }
            });

            return $this;
        });

    }
}
