<?php


namespace App\Providers;


use App\Repository\AddressRepository;
use App\Repository\ClientPaymentGymRepository;
use App\Repository\ClientRepository;
use App\Repository\EmployeeRepository;
use App\Repository\GymRepository;
use App\Repository\Interfaces\AddressRepositoryInterface;
use App\Repository\Interfaces\ClientPaymentGymRepositoryInterface;
use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Repository\Interfaces\EmployeeRepositoryInterface;
use App\Repository\Interfaces\GymRepositoryInterface;
use App\Repository\Interfaces\PaymentRepositoryInterface;
use App\Repository\Interfaces\PersonRepositoryInterface;
use App\Repository\Interfaces\RolesRepositoryInterface;
use App\Repository\Interfaces\TrainRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\PaymentRepository;
use App\Repository\PersonRepository;
use App\Repository\RolesRepository;
use App\Repository\TrainRepository;
use App\Repository\UserRepository;
use App\Service\AddressService;
use App\Service\ClientPaymentGymService;
use App\Service\ClientService;
use App\Service\GymService;
use App\Service\Interfaces\AddressServiceInterface;
use App\Service\Interfaces\ClientPaymentGymServiceInterface;
use App\Service\Interfaces\ClientServiceInterface;
use App\Service\Interfaces\EmployeeService;
use App\Service\Interfaces\EmployeeServiceInterface;
use App\Service\Interfaces\GymServiceInterface;
use App\Service\Interfaces\LoginServiceInterface;
use App\Service\Interfaces\PaymentServiceInterface;
use App\Service\Interfaces\PersonServiceInterface;
use App\Service\Interfaces\RolesServiceInterface;
use App\Service\Interfaces\TrainServiceInterface;
use App\Service\Interfaces\UserServiceInterface;
use App\Service\LoginService;
use App\Service\PaymentService;
use App\Service\PersonService;
use App\Service\RolesService;
use App\Service\TrainService;
use App\Service\UserService;
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
        $this->clientConfigSingleton();
        $this->employeeConfigSingleton();
        $this->gymConfingSingleton();
        $this->addressConfigSingleton();
        $this->userConfigSingleton();
        $this->rolesConfigSingleton();
        $this->paymentConfigSingleton();
        $this->clientPaymentGymSingleton();
        $this->loginSingleton();

    }

    private function personConfigSingleton(){
        $this->app->singleton(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->singleton(PersonServiceInterface::class, PersonService::class);

    }

    private function trainConfigSingleton(){
        $this->app->singleton(TrainRepositoryInterface::class, TrainRepository::class);
        $this->app->singleton(TrainServiceInterface::class, TrainService::class);
    }

    private function clientConfigSingleton(){
        $this->app->singleton(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->singleton(ClientServiceInterface::class, ClientService::class);

    }

    private function employeeConfigSingleton(){
        $this->app->singleton(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->singleton(EmployeeServiceInterface::class, EmployeeService::class);
    }

    private function gymConfingSingleton(){
        $this->app->singleton(GymRepositoryInterface::class, GymRepository::class);
        $this->app->singleton(GymServiceInterface::class, GymService::class);}

    private function addressConfigSingleton(){
        $this->app->singleton(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->singleton(AddressServiceInterface::class, AddressService::class);
    }

    private function rolesConfigSingleton(){
        $this->app->singleton(RolesRepositoryInterface::class, RolesRepository::class);
        $this->app->singleton(RolesServiceInterface::class, RolesService::class);}

    private function userConfigSingleton(){
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);
    }

    private function paymentConfigSingleton(){
        $this->app->singleton(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->singleton(PaymentServiceInterface::class, PaymentService::class);}

    private function loginSingleton(){
        $this->app->singleton(LoginServiceInterface::class, LoginService::class);
    }
    private function clientPaymentGymSingleton(){
        $this->app->singleton(ClientPaymentGymRepositoryInterface::class, ClientPaymentGymRepository::class);
        $this->app->singleton(ClientPaymentGymServiceInterface::class, ClientPaymentGymService::class);}

}