<?php

//使うコントローラーを記載
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::get("/", [LoginController::class, "goLogin"]);
Route::post("/login", [LoginController::class, "login"]);
Route::get("/logout", [LoginController::class, "logout"]);
Route::get("/reports/showList", [
    ReportController::class,
    "showList"
])->middleware("logincheck");
//ページネーション用（後ろにページャ用の値がついてる）
Route::get("/reports/showList{page}", [
    ReportController::class,
    "showList"
])->middleware("logincheck");
Route::get("/reports/goAdd", [
    ReportController::class,
    "goAdd"
])->middleware("logincheck");
Route::post("/reports/add", [
    ReportController::class,
    "add"
])->middleware("logincheck");
Route::get("/reports/prepareEdit/{reportId}", [
    ReportController::class,
    "prepareEdit"
])->middleware("logincheck");
Route::post("/reports/edit", [
    ReportController::class,
    "edit"
])->middleware("logincheck");
Route::get("/reports/confirmDelete/{reportId}", [
    ReportController::class,
    "confirmDelete"
])->middleware("logincheck");
Route::post("/reports/delete", [
    ReportController::class,
    "delete"
])->middleware("logincheck");
Route::get("/reports/showDetail/{reportId}", [
    ReportController::class,
    "showDetail"
])->middleware("logincheck");

//ユーザ追加
Route::get("/users/goUserAdd", [
    UserController::class,
    "goUserAdd"
])->middleware("logincheck");
Route::post("/users/userAdd", [
    UserController::class,
    "userAdd"
])->middleware("logincheck");

//ユーザ一覧
Route::get("/users/showUserList", [
    UserController::class,
    "showUserList"
])->middleware("logincheck");
//ページネーション用（後ろにページャ用の値がついてる）
Route::get("/users/showList{page}", [
    UserController::class,
    "showUserList"
])->middleware("logincheck");

//ユーザ編集
Route::get("/users/prepareUserEdit/{userId}", [
    UserController::class,
    "prepareUserEdit"
])->middleware("logincheck");
Route::post("/users/userEdit", [
    UserController::class,
    "userEdit"
])->middleware("logincheck");
