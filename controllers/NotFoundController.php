<?php
class NotFoundController extends controller
{

    public function index()
    {
        header('location: '.BASE_URL);
    }
}
