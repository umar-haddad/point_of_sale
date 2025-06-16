<?php

function group1()
{
    // instructor
    return ('1');
}
function group2()
{
    // student
    return ('2');
}
function group3()
{
    // 3: user, 4: PIC
    return ['3', '4'];
}
function role_available()
{
    // 1=instructor, 2=student
    return ['1', '2'];
}

function addingModule($role)
{
    return $role = group1();
}
