<?php


namespace App\Providers;


use App\Repository\Interfaces\PersonRepositoryInterface;
use App\Repository\PersonRepository;
use App\Service\Interfaces\PersonServiceInterface;
use App\Service\PersonService;
use Illuminate\Support\ServiceProvider;

class DependencyResolverServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->configModulos();
    }

    public function configModulos()
    {
        $this->personConfigSingleton();
        $this->trainConfigSingleton();

    }

    private function personConfigSingleton(){
        $this->app->singleton(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->singleton(PersonServiceInterface::class, PersonService::class);

    }

    private function trainConfigSingleton(){
        $this->app->singleton(TrainRepositoryInterface::class, TrainRepository::class);
        $this->app->singleton(TrainServiceInterface::class, TrainService::class);
    }

    private function clientConfigSingleton(){}

    private function employeeConfigSingleton(){}

    private function gymConfingSingleton(){}

    private function addressConfigSingleton(){}

    private function userRoleConfigSingleton(){}

    private function userConfigSingleton(){}

    private function paymentConfigSingleton(){}

    private function clientPaymentGym(){}


}