<?php

function isLogin()
{
    $ci = &get_instance();
    return $ci->session->level != null;
}

function isUser()
{
    $ci = &get_instance();
    return $ci->session->level == 'user';
}

function isAdmin()
{
    $ci = &get_instance();
    return $ci->session->level == 'admin';
}

function isSuperAdmin()
{
    $ci = &get_instance();
    return $ci->session->level == 'superadmin';
}

function isFrontdesk()
{
    $ci = &get_instance();
    return $ci->session->level == 'frontdesk' || $ci->session->level == 'superadmin';
}

function isPartman()
{
    $ci = &get_instance();
    return $ci->session->level == 'partman' || $ci->session->level == 'superadmin';
}

function show404IfNotAdmin()
{
    if (!isAdmin()) {
        redirect('error404');
    }
}

function redirectIfNotLogin()
{
    $ci = &get_instance();
    if ($ci->session->userdata('status') != "login") {
        return redirect('auth', 'refresh');
    }
}
function redirectIfLogin()
{
    $ci = &get_instance();
    if ($ci->session->userdata('status') == "login") {
        return redirect('dashboard', 'refresh');
    }
}

function redirectIfSuperadmin()
{
    $ci = &get_instance();
    if ($ci->session->userdata('level') == "superadmin") {
        return show_404();
    }
}

function redirectIfNotSuperadmin()
{
    $ci = &get_instance();
    if ($ci->session->userdata('level') != "superadmin") {
        return show_404();
    }
}

function redirectIfNotPartman()
{
    $ci = &get_instance();
    if ($ci->session->userdata('level') != "partman") {
        if ($ci->session->userdata('level') != "superadmin") {
            return show_404();
        }
    }
}

function redirectIfNotFrontdesk()
{
    $ci = &get_instance();
    if ($ci->session->userdata('level') != "frontdesk") {
        if ($ci->session->userdata('level') != "superadmin") {
            return show_404();
        }
    }
}

function getUserData()
{
    $ci = &get_instance();
    $ci->load->model('modelUser');
    return $ci->modelUser->findBy('user_id', $ci->session->userid);
}

function getUserAccount()
{
    $ci = &get_instance();
    $ci->load->model('modelUser');
    return $ci->modelUser->findByUserAccount('user_id', $ci->session->userid);
}


function logoText($logoName, $cssClass, $getUrlLogo)
{
    $setUrlLogo = base_url() . "$getUrlLogo";
    $result = "<a href='$setUrlLogo' class='az-logo $cssClass'>$logoName</a>";
    return $result;
}


function buttonComp($btnType, $btnText, $btnIcon, $btnStyle, $btnExtClass)
{
    $result = "";
    $result .= "<button type='$btnType' class='btn btn-with-icon rounded-10 $btnStyle $btnExtClass'>";
    if (!empty($btnIcon)) :
        $result .= "<i class='$btnIcon'></i>";
    endif;
    $result .= "$btnText";
    $result .= "</button>";
    return $result;
}

function buttonSubmit($btnText, $btnIcon, $btnExtClass)
{
    $result = "";
    $result .= "<button type='submit' class='btn btn-with-icon rounded-10 btn-az-primary $btnExtClass'>";
    if (!empty($btnIcon)) :
        $result .= "<i class='$btnIcon'></i>";
    endif;
    $result .= "$btnText";
    $result .= "</button>";
    return $result;
}

function buttonCancel($btnDismiss)
{
    $result = "<button type='button' data-dismiss='$btnDismiss' class='btn btn-outline-light rounded-10'> Cancel </button>";
    return $result;
}

function setDate($getDates)
{
    return date('D , d F Y', strtotime($getDates));
}

function setTimeDate($getDates)
{
    return date('d F Y - H:i', strtotime($getDates));
}

function transType($getData)
{

    if ($getData == 1) :
        return "Service + Sparepart";
    elseif ($getData == 2) :
        return "Service Only";
    else :
        return "Sparepart";
    endif;
}
