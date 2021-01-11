<?php

namespace App\Util;

class TokenGenerator
{
    public function generateApiToken(): string
    {
        try {
            $generateToken = random_bytes(10);
        } catch (\Exception $e) {
            throw new \Error("Error");
        }
        $generateToken = bin2hex($generateToken);
        $date = new \DateTimeImmutable();
        return $generateToken.$date->format('dmYHis');
    }
}
