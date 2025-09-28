<?php

namespace App\Utils;

class AppStatic
{
    CONST WRITE_RAP_LICENSE_URL = "#";
    const DS              = DIRECTORY_SEPARATOR;
    const TRUE            = true;
    const FALSE           = false;
    const TYPE_FLAT       = 1;
    const TYPE_PERCENTAGE = 2;

    const IS_WP_SYNC      = 1;
    const ACTIVE          = 1;
    const EXPIRED         = 1;
    const IS_FOCUS_KEYWORD   = 1;

    # table data status
    public const STATUS_ARR = [
        1 => 'Active',
        0 => 'Disable',
    ];

    CONST NEW_POST = 2;
    const EXISTING_POST = 1;
    const REWRITE_TYPES = [
        'rewrite'            => 'Re-Write',
        'summarize'          => 'Summarize',
        'make_it_longer'     => "Make it longer",
        'make_it_shorter'    => 'Make It Shorter',
        'improve_writing'    => 'Improve Writing',
        'grammar_correction' => 'Grammatical Improvement'
    ];

    # Event Error Detection
    const TT_ERROR = "[TT_ERROR]";


    

    
    # Request Response Codes
    public const SUCCESS            = 200;
    public const SUCCESS_WITH_DATA  = 201;
    public const VALIDATION_ERROR   = 400;
    public const NOT_FOUND          = 404;
    public const UNAUTHORIZED        = 401;
    public const UNAUTHORIZED_ACTION = 401;

    public const LENGTH_ERROR       = 411;
    public const INTERNAL_ERROR     = 500;
    public const INVALID            = 525;
    public const DUPLICATE_CODE     = 23000;
    public const OPEN_AI_ERROR_CODE = 505;
    public const BALANCE_ERROR      = 400;

    public const RESPONSE_STATUS   = [
        200 => ['status' => true,   'response_code' => 200],
        201 => ['status' => true,   'response_code' => 201],
        400 => ['status' => false,  'response_code' => 400],
        401 => ['status' => false,  'response_code' => 401],
        404 => ['status' => false,  'response_code' => 404],
        411 => ['status' => false,  'response_code' => 411],
        500 => ['status' => false,  'response_code' => 500],
    ];

    public const INPUT_TYPES   = [
        'text'     => 'Text',
        'textarea' => 'Textarea'
    ];


    #Login Center
    public const MESSAGE_WELCOME_BACK           = "Welcome Back!";
    public const MESSAGE_SUCCESS_LOGOUT         = "Aww! Logout. We are waiting for you ;) Come back soon!.";
    public const MESSAGE_INVALID                = "Invalid Information!";
    public const MESSAGE_PROFILE                = "Authorized user Data";
    public const MESSAGE_UNAUTHORISED           = "Opps! You are not authorized, please Login first.";
    public const MESSAGE_DELETE                 = "Deleted! A Record successfully deleted";
    public const MESSAGE_STORE                  = "A Record has been successfully stored.";
    public const MESSAGE_UPDATE                 = "A Record has been successfully updated.";
    public const MESSAGE_DELETE_SUCCESS_POP_UP  = "Deleted!";
    public const MESSAGE_ACTION_FAILED          = "Sorry, Can't complete the action.";
    public const MESSAGE_EXPIRED                = "Sorry, It's already expired";
    public const MESSAGE_TICKET_CLOSED          = "Sorry, This ticket has already been closed.";
    public const MESSAGE_KEYWORD_GENERATED      = "Successfully New Keywords content generated.";
    public const MESSAGE_TITLE_GENERATED        = "Successfully New Titles content generated.";
    public const MESSAGE_OUTLINE_GENERATED      = "Successfully New Outlines content generated.";
    public const MESSAGE_ARTICLE_GENERATED      = "Successfully New Article content generated.";
    public const MESSAGE_CODE_GENERATED         = "Successfully New Code content generated.";
    public const MESSAGE_IMAGE_GENERATED        = "Successfully AI image generated.";
    public const MODEL_NOT_FOUND_MESSAGE        = "Not Found Exception!";
    public const MESSAGE_UNAUTHORIZED           = "Sorry! You are not authorized to perform this action.";
    public const MESSAGE_NO_WORD_BALANCE        = "Sorry! You don't have enough word balance remaining.";



    # USER TYPES
    public const USER_TYPES = [
        1 => 'Super Admin',
        2 => 'Admin Staff',
        3 => 'Customer',
        4 => 'Customer Team'
    ];

    public const TICKET_STATUS_INSIDE   = "0 = Open, 1 = Completed/Closed, 2 = In-progress, 3 = Assigned, 4 = On-Hold, 5 = Solved, 6=Re-opened.";
    public const ACCOUNT_STATUS_INSIDE  = "0 = De-active, 1 = Active, 2 = Pending, 3 = Suspended.";
    public const ACTIVE_STATUS_INSIDE   = "0 = In-active, 1 = Active.";

    # Pagination setting
    public const PER_PAGE_DEFAULT   = 5;
    public const PER_PAGE_ARR       = [5, 10, 20, 50, 100];

}
class ResponseCode{
      # Request Response Codes
    public const SUCCESS            = 200;
    public const SUCCESS_WITH_DATA  = 201;
    public const VALIDATION_ERROR   = 400;
    public const NOT_FOUND          = 404;
    public const UNAUTHORIZED        = 401;
    public const UNAUTHORIZED_ACTION = 401;

    public const LENGTH_ERROR       = 411;
    public const INTERNAL_ERROR     = 500;
    public const INVALID            = 525;
    public const DUPLICATE_CODE     = 23000;
    public const OPEN_AI_ERROR_CODE = 505;
    public const BALANCE_ERROR      = 400;

    public const RESPONSE_STATUS   = [
        200 => ['status' => true,   'response_code' => 200],
        201 => ['status' => true,   'response_code' => 201],
        400 => ['status' => false,  'response_code' => 400],
        401 => ['status' => false,  'response_code' => 401],
        404 => ['status' => false,  'response_code' => 404],
        411 => ['status' => false,  'response_code' => 411],
        500 => ['status' => false,  'response_code' => 500],
    ];
}
