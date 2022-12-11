<?php


namespace App\Infraestructure\Controller;


use App\Application\SearchMemberByUrlAndAllWebcams\UrlNotValidException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class ErrorControllerHandler
{
    public function __construct(private LoggerInterface $logger, private Environment $environment) { }

    public function __invoke(\Throwable|\Exception $e): Response
    {
        if ($e->getPrevious() instanceof UrlNotValidException) {
            $this->logger->warning($e->getPrevious()->getMessage());

            return new Response(
                $this->environment->render("url_not_valid.html.twig", ["exception" => $e->getPrevious()]),
                404
            );
        }

        $reference = md5(uniqid());
        $this->logger->critical("$reference:: {$e->getMessage()}  ({$e->getFile()}:{$e->getLine()}");

        if ($_ENV['APP_ENV'] !== "prod") {
            throw $e;
        }

        return new Response(
            $this->environment->render(
                "error.html.twig",
                ["message" => "The website is experiencing problems, if it persists contact the administrator. Reference $reference"]
            ), 500
        );
    }
}//class