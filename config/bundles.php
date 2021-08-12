<?php
declare(strict_types=1);

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    EonX\EasyEventDispatcher\Bridge\Symfony\EasyEventDispatcherSymfonyBundle::class => ['all' => true],
    EonX\EasyUtils\Bridge\Symfony\EasyUtilsSymfonyBundle::class => ['all' => true],
    EonX\EasyLogging\Bridge\Symfony\EasyLoggingSymfonyBundle::class => ['all' => true],
    EonX\EasyErrorHandler\Bridge\Symfony\EasyErrorHandlerSymfonyBundle::class => ['all' => true],
    EonX\EasyCore\Bridge\Symfony\EasyCoreSymfonyBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Nelmio\CorsBundle\NelmioCorsBundle::class => ['all' => true],
    ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle::class => ['all' => true],
    League\FlysystemBundle\FlysystemBundle::class => ['all' => true],
    EonX\EasyHttpClient\Bridge\Symfony\EasyHttpClientSymfonyBundle::class => ['all' => true],
];
