<?php


class PasswordHash
{
    public function getHash($password)
    {
        return md5($password);
    }
}