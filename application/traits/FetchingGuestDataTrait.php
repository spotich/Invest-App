<?php

namespace InvestApp\application\traits;
use stdClass;

trait FetchingGuestDataTrait
{
    private function fetchGuestData(): ?stdClass
    {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $guest = new stdClass();
            $guest->email = $_POST['email'];
            $guest->password = $_POST['password'];
            return $guest;
        }
        return null;
    }
}