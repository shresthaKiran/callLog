<?php

function getStatusName($code)
{
    if ($code == 0) {
        return "New";
    }

    if ($code == 1) {
        return "In Progress";
    }

    if ($code == 2) {
        return "Completed";
    }
}
