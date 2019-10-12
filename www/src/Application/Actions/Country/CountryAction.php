<?php

namespace App\Application\Actions\Country;

use App\Application\Actions\Action;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Service\Country\Country;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class CountryAction extends Action
{

    public function __construct(LoggerInterface $logger, Country $country)
    {
        parent::__construct($logger);
        $this->country = $country;
    }

    /**
     * @return Response
     */
    protected function action(): Response
    {
        $rows = $this->country->getByIso("AT");
        print_r($rows);
//        $row = Country::where("iso", "AT")->get();
//        $row->phonecode = 123;
//        $row->save();

        $this->response->getBody()->write("this is book");
        return $this->response;
    }
}