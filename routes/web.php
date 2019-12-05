<?php
use Illuminate\Support\Facades\Route;
Route::domain('www.techfest.org')->group(function(){
    Route::any('/',function(){
        return redirect('https://techfest.org');
    });
    Route::any('/{any}',function($any){
        return redirect('https://techfest.org/'.$any);
    });
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/app', 'http://beta.techfest.org');
Route::redirect('/m/segreta', 'http://techfest.org//segreta');
Route::redirect('/Segreta', 'http://techfest.org//segreta');

Route::get('/app2', function () {return view('2019.app.app');});
//Route::get('/segreta', function () {return view('2019.segrita.segrita');});
//Route::get('/m/segreta', function () {return view('2019.segrita.m_segrita');});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/technoholix', 'Admin\DatabaseController@techx');
    Route::get('/lolg', 'PaymentController@addPayment');
    Route::post('/lolg', 'PaymentController@postPayment');
    Route::prefix('/certificate-last')->group(function () {
        Route::get('/', 'Certificate\CertificateController@Get');
        Route::post('/send', 'Certificate\CertificateController@Send');
        Route::post('/teamids', 'Certificate\CertificateController@teamIds');
        Route::post('/create', 'Certificate\CertificateController@create');
    });
    Route::get('/generateCas', 'Certificate\CertificateController@generateCATable');
    Route::get('/certi-test', 'Certificate\CertificateController@test');
    Route::get('/login', 'AdminController@loginGet')->name('loginGet');
    Route::post('/login', 'AdminController@loginPost')->name('loginPost');
    Route::get('/logout', 'AdminController@logoutGet')->name('logoutGet');
    Route::get('/referal', 'AdminController@caReferal');
    Route::get('/certificate-dedo', 'Certificate\CertificateController@certificateSelect');
    Route::post('/compipost', 'AdminController@getRegistrationsPost');
    Route::middleware('admin.route')->group(function () {
        Route::prefix('/ca')->name('ca.')->group(function () {
            Route::get('/list', 'AdminController@caListGet')->name('listGet');
            Route::get('/task-create', 'AdminController@caTaskCreateGet')->name('taskCreateGet');
            Route::get('/image', 'AdminController@caImageGet')->name('imageVerifyGet');
            Route::post('/task-create', 'AdminController@caTaskCreatePost')->name('taskCreatePost');
            Route::get('/image/update/{id}/{points}', 'AdminController@caImageUpdateIdPointsGet')->name('imageUpdateIdPointsGet');
            Route::get('/competitions', 'AdminController@competitions');
        });
        Route::prefix('/competitions')->name('competitions.')->group(function () {
            Route::get('/registrations', 'AdminController@competitionsRegistrationsGet')->name('registrationsGet');
        });
    });

    Route::get('/payment_test','PaymentController@post_auth');
//    Route::get('/payment', function () {
//        return "Sorry the payment portal has closed";
//    });
    Route::get('/accommodation1', 'PaymentController@auth');
    Route::middleware('admin')->group(function () {
        Route::get('/kanni', 'AdminController@kannikafunction');
        Route::any('/admin-admin', 'PaymentController@paymentTcfPost')->name('paymentTcfPost');
        Route::any('/admin-debug', 'PaymentController@adminDebug');
        Route::any('/refund', 'PaymentController@refunded');
        Route::get('/database', 'AdminController@databaseGet');
        Route::get('/payment-seen', 'PaymentController@updatePayments');
        Route::get('/team-seen/{k}', 'PaymentController@getTeams');
        Route::get('/get-all', 'AdminController@searchResult');
        Route::get('/make-session', 'AdminController@makeSession');
        Route::get('/kaka', 'Certificate\CertificateController@caUsers');
        Route::prefix('/certificate')->group(function () {
            Route::get('/', 'Certificate\AdminController@Get');
            Route::get('/generate/{id}', 'Certificate\AdminController@generateId');
        });
        Route::prefix('/certificate/new')->group(function () {
            Route::get('/', 'Certificate\AdminController@GetNew');
            Route::get('/generate/{id}', 'Certificate\AdminController@generateIdNew');
        });
        Route::any('/old', 'AdminController@oldAny');
        Route::get('/dashboard', 'AdminController@dashboardGet')->name('dashboardGet');

        Route::prefix('/create')->group(function () {
            Route::get('/{id}', 'AdminController@createGet')->name('createGet');
            Route::post('/{id}', 'AdminController@createPost')->name('createPost');
        });
        Route::prefix('/role')->name('role.')->group(function () {
            Route::get('/', 'AdminController@adminRoleGet')->name('Get');
            Route::post('/create', 'AdminController@adminRoleCreatePost')->name('createPost');
            Route::post('/delete', 'AdminController@adminRoleDeleteIdPost')->name('deleteIdPost');
            Route::get('/{id}', 'AdminController@adminRoleIdGet')->name('idGet');
            Route::post('/{id}', 'AdminController@adminRoleIdPost')->name('idPost');
        });
        Route::prefix('/mail')->name('mail.')->group(function () {
            Route::get('/', 'Mail\MailController@Get')->name('Get');
            Route::get('/workshopMail', 'Mail\MailController@workshop')->name('workshop');
            Route::get('/mail/list', 'Mail\MailController@mailListGet')->name('mail.listGet');
            Route::get('/list', 'Mail\MailController@listGet')->name('listGet');
            Route::get('/{mail}', 'Mail\MailController@mailGet')->name('mailGet');
            Route::get('/create/template', 'Mail\MailController@createTemplateGet')->name('create.templateGet');
            Route::Post('/create/template', 'Mail\MailController@createTemplatePost')->name('create.templatePost');
            Route::Post('/{mail}/destroy', 'Mail\MailController@mailDestroyPost')->name('mail.destroyPost');
            Route::get('/{mail}/edit', 'Mail\MailController@mailEditGet')->name('mail.editGet');
            Route::Post('/send', 'Mail\MailController@sendPost')->name('sendPost');
            Route::Post('/{mail}/edit', 'Mail\MailController@mailEditPost')->name('mail.editPost');
            Route::prefix('/recipents')->name('recipents.')->group(function () {
                Route::get('/list', 'Mail\MailController@recipentlistGet')->name('listGet');
                Route::get('/create', 'Mail\MailController@recipentCreateGet')->name('createGet');
                Route::post('/create', 'Mail\MailController@recipentCreatePost')->name('createPost');
                Route::get('/get/{recipent}', 'Mail\MailController@recipentGet')->name('recipentGet');
                Route::get('{recipent}/update', 'Mail\MailController@recipentUpdateGet')->name('updateGet');
                Route::get('{recipent}/update', 'Mail\MailController@recipentUpdateGet')->name('updateGet');
                Route::Post('{recipent}/update', 'Mail\MailController@recipentUpdatePost')->name('updatePost');
                Route::Post('/{recipent}/delete', 'Mail\MailController@recipentDestroyPost')->name('deletePost');
            });
        });
        Route::get('/create', 'AdminController@adminCreateGet')->name('adminCreateGet');
        Route::post('/create', 'AdminController@adminCreatePost')->name('adminCreatePost');
    });
    Route::prefix('/competitions')->name('competitions.')->group(function () {
        Route::get('/list', 'Admin\CompetitionsController@listGet')->name('listGet');
    });
});

Route::get('/', function () {    return view('2019.launch');});
Route::redirect('tf','/');

Route::get('/ca','CaController@indexPost');
Route::post('/ca','CaController@indexPost');

Route::get('/registration','CaController@reg');
Route::post('/regform','CaController@ca_data_update');
Route::get('/dashboard','CaController@dashboard');
Route::get('/tf/logout','CaController@ca_logout')->name('ca_logout');
Route::get('/imgupload/{id}','CaController@imgupload');
Route::post('/imgupload/{id}','CaController@ca_image_upload');

Route::post('/competitions/cozmo/remove/{id}','MainController@cozmo_remove_member');
Route::get('/competitions/cozmo/remove/{id}','MainController@cozmo_remove_member');



Route::get('/adminca','CaController@caevents');
Route::post('/adminca','CaController@adminca');

Route::get('/mail','CaController@mail');

//Route::get('/penaltymail/','CaController@imageverify');
Route::get('/penaltymail/{email}','CaController@imageverify');


Route::domain('m.techfest.org')->name('mobile.')->middleware('minify')->group(function() {
    Route::redirect('/ca', 'https://techfest.org/ca');
});



Route::redirect('/college-ambassador','/ca');
Route::redirect('/CA','/ca');
Route::redirect('/caportal','/ca');
Route::redirect('/cr','/ca');


Route::get('/admins','CaController@cadata');







Route::get('/reg_logout','MainController@reg_logout');


Route::get('/footer', function () {return view('2019.layouts.footer');});

Route::get('/livetable', 'AjaxdataController@index');
Route::get('/livetable/fetch_data', 'AjaxdataController@fetch_data');
Route::post('/livetable/add_data', 'AjaxdataController@add_data')->name('livetable.add_data');
Route::post('/livetable/update_data', 'AjaxdataController@update_data')->name('livetable.update_data');
Route::post('/livetable/delete_data', 'AjaxdataController@delete_data')->name('livetable.delete_data');


Route::redirect('/admindashboard/', '/admindashboard/Mumbai/cozmo');
Route::redirect('/admindashboard/Mumbai/cozmo', '/admindashboard/cozmo');
//Route::get('/admindashboard/{zonal}/{competition}/', 'tfadminController@adminDashboard');
Route::get('/admindashboard/{competition}/', 'tfadminController@adminDashboard');
Route::get('/admindashboard_login', 'tfadminController@indexPost');
Route::post('/admindashboard_login', 'tfadminController@indexPost');
Route::get('/admindashboard-total', 'tfadminController@adminDashboard_total');
Route::get('/admindashboard_subscribe', 'tfadminController@adminDashboard_subscribe');
Route::get('/admindashboard_robowars', 'tfadminController@adminDashboard_robowars');
Route::get('/admindashboard_ift', 'tfadminController@adminDashboard_ift');
Route::get('/admindashboard_summit', 'tfadminController@adminDashboard_summit');
Route::get('/admindashboard_exhibitions', 'tfadminController@adminDashboard_exhibitions');
Route::get('/admindashboard_workshops/{workshop}', 'tfadminController@adminDashboard_workshops');
Route::get('/admindashboard_payment_mun', 'tfadminController@adminDashboard_payment_mun');
Route::get('/admindashboard_payment_workshops', 'tfadminController@adminDashboard_payment_workshops');
Route::get('/admindashboard_ic', 'tfadminController@admindashboard_ic');
Route::get('/admindashboard_hospitality', 'tfadminController@admindashboard_hospitality');
Route::get('/payment_fix', function () {return view('2019.adminDashboard.payment_fix')->with(['id' =>0]);});
//Route::get('/payment_fix', 'tfadminController@payment_fix');
Route::post('/payment_fix', 'tfadminController@payment_fix');
















// 2019 links
Route::get('/competitions/logout', 'MainController@competitions_logout');

Route::get('/competitions', 'MainController@competitions');
Route::post('/competitions', 'MainController@competitions');
Route::redirect('/technorion', 'http://techfest.org/competitions#techno-section');
Route::redirect('/ideate', 'http://techfest.org/competitions');
Route::redirect('/competition', 'http://techfest.org/competitions');

Route::redirect('/cozmo', '/competitions/wcozmo');
Route::redirect('/competitions/cozmo', '/competitions/wcozmo');
//Route::get('/competitions/cozmo', 'MainController@cozmo');
//Route::post('/competitions/cozmo', 'MainController@cozmo');
Route::get('/competitions/cozmo/reg','MainController@regcozmo');
Route::get('/competitions/cozmo/jointeam', 'MainController@cozmo_join_team_form');
Route::post('/competitions/cozmo/jointeam', 'MainController@cozmo_join_team_reg');
Route::get('/competitions/cozmo/createteam', 'MainController@cozmo_create_team_form');
Route::post('/competitions/cozmo/createteam', 'MainController@cozmo_create_team_reg');
Route::get('/competitions/cozmo/leaveteam', 'MainController@cozmo_leave_team');
Route::get('/competitions/cozmo/dissolveteam', 'MainController@cozmo_dissolve');
Route::post('/competitions/cozmo/remove/{id}','MainController@cozmo_remove_member');
Route::get('/competitions/cozmo/remove/{id}','MainController@cozmo_remove_member');


Route::redirect('/wcozmo.', '/competitions/wcozmo');
Route::redirect('/wcozmo', '/competitions/wcozmo');
Route::get('/competitions/wcozmo', 'MainController@wcozmo');
Route::post('/competitions/wcozmo', 'MainController@wcozmo');
Route::get('/competitions/wcozmo/reg','MainController@regwcozmo');
Route::get('/competitions/wcozmo/jointeam', 'MainController@wcozmo_join_team_form');
Route::post('/competitions/wcozmo/jointeam', 'MainController@wcozmo_join_team_reg');
Route::get('/competitions/wcozmo/createteam', 'MainController@wcozmo_create_team_form');
Route::post('/competitions/wcozmo/createteam', 'MainController@wcozmo_create_team_reg');
Route::get('/competitions/wcozmo/leaveteam', 'MainController@wcozmo_leave_team');
Route::get('/competitions/wcozmo/dissolveteam', 'MainController@wcozmo_dissolve');
Route::post('/competitions/wcozmo/remove/{id}','MainController@wcozmo_remove_member');
Route::get('/competitions/wcozmo/remove/{id}','MainController@wcozmo_remove_member');



Route::redirect('/meshmerize', '/competitions/wmeshmerize');
Route::redirect('/competitions/meshmerize', '/competitions/wmeshmerize');
//Route::get('/competitions/meshmerize', 'MainController@meshmerize');
//Route::post('/competitions/meshmerize', 'MainController@meshmerize');
Route::get('/competitions/meshmerize/reg','MainController@regmeshmerize');
Route::get('/competitions/meshmerize/jointeam', 'MainController@meshmerize_join_team_form');
Route::post('/competitions/meshmerize/jointeam', 'MainController@meshmerize_join_team_reg');
Route::get('/competitions/meshmerize/createteam', 'MainController@meshmerize_create_team_form');
Route::post('/competitions/meshmerize/createteam', 'MainController@meshmerize_create_team_reg');
Route::get('/competitions/meshmerize/leaveteam', 'MainController@meshmerize_leave_team');
Route::get('/competitions/meshmerize/dissolveteam', 'MainController@meshmerize_dissolve');
Route::post('/competitions/meshmerize/remove/{id}','MainController@meshmerize_remove_member');
Route::get('/competitions/meshmerize/remove/{id}','MainController@meshmerize_remove_member');


Route::redirect('/wmeshmerize.', '/competitions/wmeshmerize');
Route::redirect('/wmeshmerize', '/competitions/wmeshmerize');
Route::get('/competitions/wmeshmerize', 'MainController@wmeshmerize');
Route::post('/competitions/wmeshmerize', 'MainController@wmeshmerize');
Route::get('/competitions/wmeshmerize/reg','MainController@regwmeshmerize');
Route::get('/competitions/wmeshmerize/jointeam', 'MainController@wmeshmerize_join_team_form');
Route::post('/competitions/wmeshmerize/jointeam', 'MainController@wmeshmerize_join_team_reg');
Route::get('/competitions/wmeshmerize/createteam', 'MainController@wmeshmerize_create_team_form');
Route::post('/competitions/wmeshmerize/createteam', 'MainController@wmeshmerize_create_team_reg');
Route::get('/competitions/wmeshmerize/leaveteam', 'MainController@wmeshmerize_leave_team');
Route::get('/competitions/wmeshmerize/dissolveteam', 'MainController@wmeshmerize_dissolve');
Route::post('/competitions/wmeshmerize/remove/{id}','MainController@wmeshmerize_remove_member');
Route::get('/competitions/wmeshmerize/remove/{id}','MainController@wmeshmerize_remove_member');


Route::redirect('/codecode', '/competitions/wcodecode');
Route::redirect('/competitions/codecode', '/competitions/wcodecode');
//Route::get('/competitions/codecode', 'MainController@codecode');
//Route::post('/competitions/codecode', 'MainController@codecode');
Route::get('/competitions/codecode/reg','MainController@regcodecode');
Route::get('/competitions/codecode/jointeam', 'MainController@codecode_join_team_form');
Route::post('/competitions/codecode/jointeam', 'MainController@codecode_join_team_reg');
Route::get('/competitions/codecode/createteam', 'MainController@codecode_create_team_form');
Route::post('/competitions/codecode/createteam', 'MainController@codecode_create_team_reg');
Route::get('/competitions/codecode/leaveteam', 'MainController@codecode_leave_team');
Route::get('/competitions/codecode/dissolveteam', 'MainController@codecode_dissolve');
Route::post('/competitions/codecode/remove/{id}','MainController@codecode_remove_member');
Route::get('/competitions/codecode/remove/{id}','MainController@codecode_remove_member');




Route::redirect('/wcodecode', '/competitions/wcodecode');
Route::get('/competitions/wcodecode', 'MainController@wcodecode');
Route::post('/competitions/wcodecode', 'MainController@wcodecode');
Route::get('/competitions/wcodecode/reg','MainController@regwcodecode');
Route::get('/competitions/wcodecode/jointeam', 'MainController@wcodecode_join_team_form');
Route::post('/competitions/wcodecode/jointeam', 'MainController@wcodecode_join_team_reg');
Route::get('/competitions/wcodecode/createteam', 'MainController@wcodecode_create_team_form');
Route::post('/competitions/wcodecode/createteam', 'MainController@wcodecode_create_team_reg');
Route::get('/competitions/wcodecode/leaveteam', 'MainController@wcodecode_leave_team');
Route::get('/competitions/wcodecode/dissolveteam', 'MainController@wcodecode_dissolve');
Route::post('/competitions/wcodecode/remove/{id}','MainController@wcodecode_remove_member');
Route::get('/competitions/wcodecode/remove/{id}','MainController@wcodecode_remove_member');



Route::redirect('/inspire', '/competitions/inspire');
Route::redirect('/inspirewithorg', '/competitions/inspire');
Route::get('/competitions/inspire', 'MainController@inspire');
Route::post('/competitions/inspire', 'MainController@inspire');
Route::get('/competitions/inspire/reg','MainController@reginspire');
Route::get('/competitions/inspire/jointeam', 'MainController@inspire_join_team_form');
Route::post('/competitions/inspire/jointeam', 'MainController@inspire_join_team_reg');
Route::get('/competitions/inspire/createteam', 'MainController@inspire_create_team_form');
Route::post('/competitions/inspire/createteam', 'MainController@inspire_create_team_reg');
Route::get('/competitions/inspire/leaveteam', 'MainController@inspire_leave_team');
Route::get('/competitions/inspire/dissolveteam', 'MainController@inspire_dissolve');
Route::post('/competitions/inspire/remove/{id}','MainController@inspire_remove_member');
Route::get('/competitions/inspire/remove/{id}','MainController@inspire_remove_member');


Route::redirect('/tfolympiad.', '/competitions/tso');
Route::redirect('/tfolympiad', '/competitions/tso');
Route::redirect('/tso.', '/competitions/tso');
Route::redirect('/tso', '/competitions/tso');
Route::get('/competitions/tso', 'MainController@tso');
Route::post('/competitions/tso', 'MainController@tso');
Route::get('/competitions/tso/reg','MainController@regtso');
Route::get('/competitions/tso/jointeam', 'MainController@tso_join_team_form');
Route::post('/competitions/tso/jointeam', 'MainController@tso_join_team_reg');
Route::get('/competitions/tso/createteam', 'MainController@tso_create_team_form');
Route::post('/competitions/tso/createteam', 'MainController@tso_create_team_reg');
Route::get('/competitions/tso/leaveteam', 'MainController@tso_leave_team');
Route::get('/competitions/tso/dissolveteam', 'MainController@tso_dissolve');
Route::post('/competitions/tso/remove/{id}','MainController@tso_remove_member');
Route::get('/competitions/tso/remove/{id}','MainController@tso_remove_member');

Route::redirect('/micromouse', '/competitions/micromouse');
Route::get('/competitions/micromouse', 'MainController@micromouse');
Route::post('/competitions/micromouse', 'MainController@micromouse');
Route::get('/competitions/micromouse/reg','MainController@regmicromouse');
Route::get('/competitions/micromouse/jointeam', 'MainController@micromouse_join_team_form');
Route::post('/competitions/micromouse/jointeam', 'MainController@micromouse_join_team_reg');
Route::get('/competitions/micromouse/createteam', 'MainController@micromouse_create_team_form');
Route::post('/competitions/micromouse/createteam', 'MainController@micromouse_create_team_reg');
Route::get('/competitions/micromouse/leaveteam', 'MainController@micromouse_leave_team');
Route::get('/competitions/micromouse/dissolveteam', 'MainController@micromouse_dissolve');
Route::post('/competitions/micromouse/remove/{id}','MainController@micromouse_remove_member');
Route::get('/competitions/micromouse/remove/{id}','MainController@micromouse_remove_member');


Route::redirect('/earthmatters', '/competitions/earthmatters');
Route::get('/competitions/earthmatters', 'MainController@earthmatters');
Route::post('/competitions/earthmatters', 'MainController@earthmatters');
Route::get('/competitions/earthmatters/reg','MainController@regearthmatters');
Route::get('/competitions/earthmatters/jointeam', 'MainController@earthmatters_join_team_form');
Route::post('/competitions/earthmatters/jointeam', 'MainController@earthmatters_join_team_reg');
Route::get('/competitions/earthmatters/createteam', 'MainController@earthmatters_create_team_form');
Route::post('/competitions/earthmatters/createteam', 'MainController@earthmatters_create_team_reg');
Route::get('/competitions/earthmatters/leaveteam', 'MainController@earthmatters_leave_team');
Route::get('/competitions/earthmatters/dissolveteam', 'MainController@earthmatters_dissolve');
Route::post('/competitions/earthmatters/remove/{id}','MainController@earthmatters_remove_member');
Route::get('/competitions/earthmatters/remove/{id}','MainController@earthmatters_remove_member');


Route::redirect('/transportation', '/competitions/transportation');
Route::get('/competitions/transportation', 'MainController@transportation');
Route::post('/competitions/transportation', 'MainController@transportation');
Route::get('/competitions/transportation/reg','MainController@regtransportation');
Route::get('/competitions/transportation/jointeam', 'MainController@transportation_join_team_form');
Route::post('/competitions/transportation/jointeam', 'MainController@transportation_join_team_reg');
Route::get('/competitions/transportation/createteam', 'MainController@transportation_create_team_form');
Route::post('/competitions/transportation/createteam', 'MainController@transportation_create_team_reg');
Route::get('/competitions/transportation/leaveteam', 'MainController@transportation_leave_team');
Route::get('/competitions/transportation/dissolveteam', 'MainController@transportation_dissolve');
Route::post('/competitions/transportation/remove/{id}','MainController@transportation_remove_member');
Route::get('/competitions/transportation/remove/{id}','MainController@transportation_remove_member');

Route::redirect('/innovationeering', '/competitions/innovationeering');
Route::get('/competitions/innovationeering', 'MainController@innovationeering');
Route::post('/competitions/innovationeering', 'MainController@innovationeering');
Route::get('/competitions/innovationeering/reg','MainController@reginnovationeering');
Route::get('/competitions/innovationeering/jointeam', 'MainController@innovationeering_join_team_form');
Route::post('/competitions/innovationeering/jointeam', 'MainController@innovationeering_join_team_reg');
Route::get('/competitions/innovationeering/createteam', 'MainController@innovationeering_create_team_form');
Route::post('/competitions/innovationeering/createteam', 'MainController@innovationeering_create_team_reg');
Route::get('/competitions/innovationeering/leaveteam', 'MainController@innovationeering_leave_team');
Route::get('/competitions/innovationeering/dissolveteam', 'MainController@innovationeering_dissolve');
Route::post('/competitions/innovationeering/remove/{id}','MainController@innovationeering_remove_member');
Route::get('/competitions/innovationeering/remove/{id}','MainController@innovationeering_remove_member');


Route::redirect('/metamorphosis', '/competitions/metamorphosis');
Route::get('/competitions/metamorphosis', 'MainController@metamorphosis');
Route::post('/competitions/metamorphosis', 'MainController@metamorphosis');
Route::get('/competitions/metamorphosis/reg','MainController@regmetamorphosis');
Route::get('/competitions/metamorphosis/jointeam', 'MainController@metamorphosis_join_team_form');
Route::post('/competitions/metamorphosis/jointeam', 'MainController@metamorphosis_join_team_reg');
Route::get('/competitions/metamorphosis/createteam', 'MainController@metamorphosis_create_team_form');
Route::post('/competitions/metamorphosis/createteam', 'MainController@metamorphosis_create_team_reg');
Route::get('/competitions/metamorphosis/leaveteam', 'MainController@metamorphosis_leave_team');
Route::get('/competitions/metamorphosis/dissolveteam', 'MainController@metamorphosis_dissolve');
Route::post('/competitions/metamorphosis/remove/{id}','MainController@metamorphosis_remove_member');
Route::get('/competitions/metamorphosis/remove/{id}','MainController@metamorphosis_remove_member');


Route::redirect('/indiachallenge', '/competitions/indiachallenge');
Route::redirect('/IndiaChallenge', '/competitions/indiachallenge');
Route::get('/competitions/indiachallenge', 'MainController@indiachallenge');
Route::post('/competitions/indiachallenge', 'MainController@indiachallenge');
Route::get('/competitions/indiachallenge/reg','MainController@regindiachallenge');
Route::get('/competitions/indiachallenge/jointeam', 'MainController@indiachallenge_join_team_form');
Route::post('/competitions/indiachallenge/jointeam', 'MainController@indiachallenge_join_team_reg');
Route::get('/competitions/indiachallenge/createteam', 'MainController@indiachallenge_create_team_form');
Route::post('/competitions/indiachallenge/createteam', 'MainController@indiachallenge_create_team_reg');
Route::get('/competitions/indiachallenge/leaveteam', 'MainController@indiachallenge_leave_team');
Route::get('/competitions/indiachallenge/dissolveteam', 'MainController@indiachallenge_dissolve');
Route::post('/competitions/indiachallenge/remove/{id}','MainController@indiachallenge_remove_member');
Route::get('/competitions/indiachallenge/remove/{id}','MainController@indiachallenge_remove_member');


Route::redirect('/rowboatics', '/competitions/rowboatics');
Route::get('/competitions/rowboatics', 'MainController@rowboatics');
Route::post('/competitions/rowboatics', 'MainController@rowboatics');
Route::get('/competitions/rowboatics/reg','MainController@regrowboatics');
Route::get('/competitions/rowboatics/jointeam', 'MainController@rowboatics_join_team_form');
Route::post('/competitions/rowboatics/jointeam', 'MainController@rowboatics_join_team_reg');
Route::get('/competitions/rowboatics/createteam', 'MainController@rowboatics_create_team_form');
Route::post('/competitions/rowboatics/createteam', 'MainController@rowboatics_create_team_reg');
Route::get('/competitions/rowboatics/leaveteam', 'MainController@rowboatics_leave_team');
Route::get('/competitions/rowboatics/dissolveteam', 'MainController@rowboatics_dissolve');
Route::post('/competitions/rowboatics/remove/{id}','MainController@rowboatics_remove_member');
Route::get('/competitions/rowboatics/remove/{id}','MainController@rowboatics_remove_member');


Route::redirect('/bugbounty', '/competitions/bugbounty');
Route::get('/competitions/bugbounty', 'MainController@bugbounty');
Route::post('/competitions/bugbounty', 'MainController@bugbounty');
Route::get('/competitions/bugbounty/reg','MainController@regbugbounty');
Route::get('/competitions/bugbounty/jointeam', 'MainController@bugbounty_join_team_form');
Route::post('/competitions/bugbounty/jointeam', 'MainController@bugbounty_join_team_reg');
Route::get('/competitions/bugbounty/createteam', 'MainController@bugbounty_create_team_form');
Route::post('/competitions/bugbounty/createteam', 'MainController@bugbounty_create_team_reg');
Route::get('/competitions/bugbounty/leaveteam', 'MainController@bugbounty_leave_team');
Route::get('/competitions/bugbounty/dissolveteam', 'MainController@bugbounty_dissolve');
Route::post('/competitions/bugbounty/remove/{id}','MainController@bugbounty_remove_member');
Route::get('/competitions/bugbounty/remove/{id}','MainController@bugbounty_remove_member');



Route::redirect('/fintech', '/competitions/fintech');
Route::get('/competitions/fintech', 'MainController@fintech');
Route::post('/competitions/fintech', 'MainController@fintech');
Route::get('/competitions/fintech/reg','MainController@regfintech');
Route::get('/competitions/fintech/jointeam', 'MainController@fintech_join_team_form');
Route::post('/competitions/fintech/jointeam', 'MainController@fintech_join_team_reg');
Route::get('/competitions/fintech/createteam', 'MainController@fintech_create_team_form');
Route::post('/competitions/fintech/createteam', 'MainController@fintech_create_team_reg');
Route::get('/competitions/fintech/leaveteam', 'MainController@fintech_leave_team');
Route::get('/competitions/fintech/dissolveteam', 'MainController@fintech_dissolve');
Route::post('/competitions/fintech/remove/{id}','MainController@fintech_remove_member');
Route::get('/competitions/fintech/remove/{id}','MainController@fintech_remove_member');



Route::redirect('/GoPYNQ', '/competitions/gopynq');
Route::redirect('/gopynq', '/competitions/gopynq');
Route::redirect('/GoPynq', '/competitions/gopynq');
Route::get('/competitions/gopynq', 'MainController@gopynq');
Route::post('/competitions/gopynq', 'MainController@gopynq');
Route::get('/competitions/gopynq/reg','MainController@reggopynq');
Route::get('/competitions/gopynq/jointeam', 'MainController@gopynq_join_team_form');
Route::post('/competitions/gopynq/jointeam', 'MainController@gopynq_join_team_reg');
Route::get('/competitions/gopynq/createteam', 'MainController@gopynq_create_team_form');
Route::post('/competitions/gopynq/createteam', 'MainController@gopynq_create_team_reg');
Route::get('/competitions/gopynq/leaveteam', 'MainController@gopynq_leave_team');
Route::get('/competitions/gopynq/dissolveteam', 'MainController@gopynq_dissolve');
Route::post('/competitions/gopynq/remove/{id}','MainController@gopynq_remove_member');
Route::get('/competitions/gopynq/remove/{id}','MainController@gopynq_remove_member');



Route::redirect('/craneomania', '/competitions/craneomania');
Route::get('/competitions/craneomania', 'MainController@craneomania');
Route::post('/competitions/craneomania', 'MainController@craneomania');
Route::get('/competitions/craneomania/reg','MainController@regcraneomania');
Route::get('/competitions/craneomania/jointeam', 'MainController@craneomania_join_team_form');
Route::post('/competitions/craneomania/jointeam', 'MainController@craneomania_join_team_reg');
Route::get('/competitions/craneomania/createteam', 'MainController@craneomania_create_team_form');
Route::post('/competitions/craneomania/createteam', 'MainController@craneomania_create_team_reg');
Route::get('/competitions/craneomania/leaveteam', 'MainController@craneomania_leave_team');
Route::get('/competitions/craneomania/dissolveteam', 'MainController@craneomania_dissolve');
Route::post('/competitions/craneomania/remove/{id}','MainController@craneomania_remove_member');
Route::get('/competitions/craneomania/remove/{id}','MainController@craneomania_remove_member');



Route::redirect('/boeing', '/competitions/boeing');
Route::redirect('/aeromodelling', '/competitions/boeing');
Route::get('/competitions/boeing', 'MainController@boeing');
Route::post('/competitions/boeing', 'MainController@boeing');
Route::get('/competitions/boeing/reg','MainController@regboeing');
Route::get('/competitions/boeing/jointeam', 'MainController@boeing_join_team_form');
Route::post('/competitions/boeing/jointeam', 'MainController@boeing_join_team_reg');
Route::get('/competitions/boeing/createteam', 'MainController@boeing_create_team_form');
Route::post('/competitions/boeing/createteam', 'MainController@boeing_create_team_reg');
Route::get('/competitions/boeing/leaveteam', 'MainController@boeing_leave_team');
Route::get('/competitions/boeing/dissolveteam', 'MainController@boeing_dissolve');
Route::post('/competitions/boeing/remove/{id}','MainController@boeing_remove_member');
Route::get('/competitions/boeing/remove/{id}','MainController@boeing_remove_member');



Route::redirect('/drone', '/competitions/dronechallenge');
Route::redirect('/dronechallenge', '/competitions/dronechallenge');
Route::get('/competitions/dronechallenge', 'MainController@dronechallenge');
Route::post('/competitions/dronechallenge', 'MainController@dronechallenge');
Route::get('/competitions/dronechallenge/reg','MainController@regdronechallenge');
Route::get('/competitions/dronechallenge/jointeam', 'MainController@dronechallenge_join_team_form');
Route::post('/competitions/dronechallenge/jointeam', 'MainController@dronechallenge_join_team_reg');
Route::get('/competitions/dronechallenge/createteam', 'MainController@dronechallenge_create_team_form');
Route::post('/competitions/dronechallenge/createteam', 'MainController@dronechallenge_create_team_reg');
Route::get('/competitions/dronechallenge/leaveteam', 'MainController@dronechallenge_leave_team');
Route::get('/competitions/dronechallenge/dissolveteam', 'MainController@dronechallenge_dissolve');
Route::post('/competitions/dronechallenge/remove/{id}','MainController@dronechallenge_remove_member');
Route::get('/competitions/dronechallenge/remove/{id}','MainController@dronechallenge_remove_member');

Route::redirect('/makerthon', '/competitions/makerthon');
Route::get('/competitions/makerthon', 'MainController@makerthon');
Route::post('/competitions/makerthon', 'MainController@makerthon');
Route::get('/competitions/makerthon/reg','MainController@regmakerthon');
Route::get('/competitions/makerthon/jointeam', 'MainController@makerthon_join_team_form');
Route::post('/competitions/makerthon/jointeam', 'MainController@makerthon_join_team_reg');
Route::get('/competitions/makerthon/createteam', 'MainController@makerthon_create_team_form');
Route::post('/competitions/makerthon/createteam', 'MainController@makerthon_create_team_reg');
Route::get('/competitions/makerthon/leaveteam', 'MainController@makerthon_leave_team');
Route::get('/competitions/makerthon/dissolveteam', 'MainController@makerthon_dissolve');
Route::post('/competitions/makerthon/remove/{id}','MainController@makerthon_remove_member');
Route::get('/competitions/makerthon/remove/{id}','MainController@makerthon_remove_member');



Route::redirect('/wpc', '/competitions/wpc');
Route::get('/competitions/wpc', 'MainController@wpc');
Route::post('/competitions/wpc', 'MainController@wpc');
Route::get('/competitions/wpc/reg','MainController@regwpc');


Route::redirect('/robovr', '/competitions/robovr');
Route::get('/competitions/robovr', function () {return view('2019.competitions.robovr');});


Route::get('/competitions/details_form','MainController@details_form');
Route::post('/competitions/details_form','MainController@details_form_reg');


Route::get('/competitions/details_form_2','MainController@details_form_2');// second form for ideate without zonals
Route::get('/competitions/details_form_school','MainController@details_form_school');// second form for ideate without zonals




Route::get('/competitions/zonals_form','MainController@zonals_form');
Route::post('/competitions/zonals_form','MainController@zonals_form_reg');








Route::get('/reg-ideate','MainController@regcozmo');


//Route::get('/summit19', 'MainController@summit');
Route::redirect('/summit19', '/summit');

Route::get('/industrysummit', function () {return view('2019.summit.summit');});
Route::get('/summit', function () {return view('2019.summit.all_summit');});
Route::get('/mediasummit', function () {return view('2019.summit.mediasummit');});
Route::post('/summit_post', 'webpagesController@summit_post');

Route::get('/esports', 'MainController@esports');

//Route::get('/workshops', 'MainController@workshops');
Route::redirect('/workshop', '/workshops');
Route::redirect('/workshops/IndustrySummit', '/industrysummit');
Route::redirect('/workshops/MediaSummit', '/mediasummit');
Route::redirect('/m/workshops/IndustrySummit', '/industrysummit');
Route::redirect('/m/workshops/MediaSummit', '/mediasummit');
Route::redirect('/EthicalHacking', '/workshops/EthicalHacking');
Route::redirect('/ethicalhacking', '/workshops/EthicalHacking');
Route::redirect('/sixthsenserobotics', '/workshops/6thSenseRobotics');
Route::redirect('/gesturerobotics', '/workshops/GestureRobotics');
Route::redirect('/automobile', '/workshops/Automobile');
Route::redirect('/Automobile', '/workshops/Automobile');
Route::redirect('/zeroenergybuilding', '/workshops/ZeroEnergyBuilding');
Route::redirect('/solarizer', '/workshops/Solarizer');
Route::redirect('/androiddevelopment', '/workshops/AndroidDevelopment');
Route::redirect('/googlecloudplatform', '/workshops/GoogleCloudPlatform');
Route::redirect('/nanotechnology', '/workshops/NanoTechnology');
Route::redirect('/underwaterrobotics', '/workshops/UnderwaterRobotics');
Route::redirect('/embeddedsystems', '/workshops/EmbeddedSystems');
Route::redirect('/artificialintelligence', '/workshops/ArtificialIntelligence');
Route::redirect('/machinelearning', '/workshops/MachineLearning');
Route::redirect('/alexaeverywhere', '/workshops/AlexaEverywhere');
Route::redirect('/digitalmarketing', '/workshops/DigitalMarketing');
Route::redirect('/quadcopter', '/workshops/Quadcopter');

Route::get('/workshops', 'WorkshopController@Get');
Route::get('/workshops_test', 'WorkshopController@Get_test');
Route::get('/workshops19', 'WorkshopController@Get');
Route::get('/m/workshops', 'WorkshopController@mobile_Get');

Route::get('/workshops/{workshop}', 'WorkshopController@get_workshop');
Route::post('/workshops/{workshop}', 'WorkshopController@get_workshop');

Route::get('/m/workshops/{workshop}', 'WorkshopController@mobile_get_workshop');

Route::post('/workshops_reg/{workshop}', 'WorkshopController@register_workshop');
Route::get('/workshops_reg/{workshop}', 'WorkshopController@reg_workshop');

Route::post('/workshops_signin/{workshop}', 'WorkshopController@reg_workshop');
Route::get('/m/workshops_signin/{workshop}', 'WorkshopController@reg_workshop_mobile');
Route::get('/workshops_/logout', 'WorkshopController@workshop_logout');

//Route::get('/hospitality', 'MainController@hospitality');

Route::get('hospitality', function () {return view('2019.hospitality.hospitality');});

Route::post('/hospitality/form', 'EventController@hospitality_pc_reg');
Route::post('/m/hospitality/form', 'EventController@hospitality_mobile_reg');

Route::post('/hospitality/form_submit', 'EventController@hospitality_form_submit');

Route::get('/m/hospitality', function () {return view('2019.hospitality.mobile.hospitality');});
//Route::post('/m/hospitality/form', 'EventController@hospitality_pc_reg');

//Route::get('hospitality_form', function () {return view('2019.hospitality.hospitality_form');});

//Route::get('/schedule', 'MainController@schedule');

Route::redirect('/initiative', '/initiatives');
Route::get('/initiatives', 'MainController@initiative');

Route::redirect('/bonehealth', '/initiatives/bone_health');
Route::get('/initiatives/bone_health', function () {return view('2019.initiatives_2019.women_health');});

Route::redirect('/iunderstand', '/initiatives/financial_literacy');
Route::redirect('/financial_literacy', '/initiatives/financial_literacy');
Route::get('/initiatives/financial_literacy', function () {return view('2019.initiatives_2019.finantial_litracy');});
Route::post('/initiative/financial_literacy/form', 'webpagesController@initiative_fin_lit_form');

Route::get('/exhibitions', function () {return view('2019.exhibitions.exhibitions');});
Route::get('/exhibitions/form', function () {return view('2019.exhibitions.exhibition_form');});
Route::post('/exhibitions/form', 'webpagesController@exhibitions_form');

Route::get('/robowars', function () {return view('2019.robowars.robowars');});
Route::redirect('/robowars19/', '/robowars/');
Route::redirect('/robowar/', '/robowars/');
Route::redirect('/robowar18/', '/robowars/');


//Route::get('/robowars19', 'MainController@robowars');
Route::get('/robowars/form', 'webpagesController@robowars_form');
Route::post('/robowars/form', 'webpagesController@robowars_form_reg');

Route::redirect('/twmun/', '/mun/');
Route::redirect('/MUN/', '/mun/');
Route::redirect('/TWMUN/', '/mun/');
Route::redirect('/twmun/2018/', '/mun/');
Route::get('/mun', 'MainController@mun');
Route::get('/mun2018', function () {return view('events.twmun');});

//Route::get('/ift', 'MainController@ift');
Route::redirect('/ift', '/fullthrottle');
Route::get('/fullthrottle', function () {return view('2019.ift.ift');});
Route::get('/ift/form', function () {return view('2019.ift.ift_form');});
Route::post('/ift/form', 'webpagesController@ift_form_reg');

Route::get('/technoholix', 'MainController@technoholix');
//Route::get('/workshops', 'MainController@workshops');
Route::get('/media', function () {return view('2019.media');});
Route::get('/lectures', function () {return view('2019.lectures');});
Route::get('/contact-us', function () {return view('2019.contactus');});
Route::get('/contact-us/overall-coordinators', function () {return view('2019.contact_us.oc');});
Route::get('/contact-us/exhibitions', function () {return view('2019.contact_us.exhibitions');});
Route::get('/contact-us/robowars', function () {return view('2019.contact_us.robowars');});
Route::get('/contact-us/marketing', function () {return view('2019.contact_us.marketing');});
Route::get('/contact-us/web-creatives', function () {return view('2019.contact_us.webnc');});
Route::get('/contact-us/lectures', function () {return view('2019.contact_us.lectures');});
Route::get('/contact-us/ozone', function () {return view('2019.contact_us.ozone');});
Route::get('/contact-us/technoholix', function () {return view('2019.contact_us.technoholix');});
Route::get('/contact-us/media-publicity', function () {return view('2019.contact_us.media');});
Route::get('/contact-us/hospitality-fnb', function () {return view('2019.contact_us.hospi');});
Route::get('/contact-us/infrastructure', function () {return view('2019.contact_us.infrastructure');});
Route::get('/contact-us/competitions', function () {return view('2019.contact_us.competitions');});
Route::get('/ozone', function () {return view('2019.ozone');});
Route::get('/sponsors', function () {return view('2019.sponsors');});
Route::get('/legals', function () {return view('2019.legals');});
Route::get('/about-us', function () {return view('2019.aboutus');});
Route::get('/theme', function () {return view('2019.theme');});
Route::get('/m', function () {return view('2019.mobilehome');});
Route::get('/m/contact-us', function () {return view('2019.m_contactus');});


Route::get('/cyclothon', function () {return view('2019.cyclothon');});

























Route::get('/refund-kardo', 'PaymentController@paidTeams');
Route::get('/give-kardo', 'PaymentController@removeTicket');
Route::get('/admin/accomodation/123', 'MainController@accoDekho');

Route::redirect('/HHDL', 'https://goo.gl/forms/sdM9rPaB1S8xbMzi2');
Route::redirect('/HHDLvisitor', 'https://goo.gl/forms/2G7MHkuuqUq5T3OJ2');
Route::redirect('/hhdlvisitor', 'https://goo.gl/forms/2G7MHkuuqUq5T3OJ2');
Route::redirect('/hhdl', 'https://goo.gl/forms/sdM9rPaB1S8xbMzi2');
Route::get('/404/{name}/{score}', 'MainController@error404Custom');
Route::redirect('/ic', '/innovationchallenge');
Route::redirect('/InnovationChallenge', '/innovationchallenge');
Route::get('/create-temp-login', function () {
    session(['admin' => 'test']);
    return redirect('/accommodation');
});
Route::middleware('admin')->group(function () {
    Route::prefix('/admin/accommodation')->group(function () {
        Route::get('/', 'Accommodation\MainController@Get')->name('admin.accommodate');
        Route::get('/accoTable', 'Accommodation\MainController@accoTable')->name('admin.accoTable');
        Route::get('/roomTable', 'Accommodation\MainController@roomTable')->name('admin.accoTable');
        Route::get('/allocate', function () {
            return view('accommodation.allocate');
        })->name('allocate');
        Route::get('/configure', function () {
            $kiu = ['1', '22', '6', '5', '51'];
            if (!in_array(session()->get('admin')->id, $kiu)) return abort(403);
            return view('accommodation.configure');
        })->name('configure');
        Route::get('/lol/{id}', 'Accommodation\MainController@getRelations');
        Route::post('/accommodate', 'Accommodation\MainController@accommodate');
        Route::post('/reset', 'Accommodation\MainController@resetAcco');
        Route::get('/documentation', function () {
            return view('accommodation.documentation');
        });
        Route::get('/full-reset', 'Accommodation\MainController@reset');
    });
});
Route::get('/mun-certificate', 'Certificate\CertificateController@munCertiGet');
Route::post('/mun-certificate', 'Certificate\CertificateController@munCertiPost');
Route::prefix('/admin/attendance')->group(function () {
    Route::get('/', 'Attendance\MainController@Get')->name('admin.attendance');
    Route::get('/reset', 'Attendance\MainController@reset')->name('admin.reset');
    Route::post('/mark/{eid}/{pid}/{slot}', 'Attendance\MainController@markGet')->name('admin.mark-attendance');
});
Route::get('/link/debug/{ticket}', 'PaymentController@ticketGet');

Route::post('/summitPost', 'EventController@summitPost')->name('summitPost');
Route::get('/logout', 'AdminController@logoutGet')->name('logoutGet');
Route::prefix('/certificate')->name('.certificate')->group(function () {
    Route::get('/verify/{id}/{pid}', 'Certificate\CertificateController@verify');
    Route::get('/gen/{id}/{pid}/{secret}', 'Certificate\CertificateController@downloadCertificate');
});
//Route::redirect('/summit', '/summit18/');
//Route::redirect('/events/twmun', '/twmun/2018');
//Route::redirect('/makerthon', '/Tata%20Makerthon%20Challenge/competition');
//Route::redirect('/periloscope', '/Periloscope%20Challenge%C2%A0/competition');
//Route::redirect('/springfield', '/Springfield%20Challenge/competition');
//Route::redirect('/vision2030', '/vision-2030/competition');
//Route::redirect('/encodesteel', '/Encode%20Steel/competition');
//Route::redirect('/tata', '/Tata%20Makerthon%20Challenge/competition');
//Route::redirect('/irc', '/International%20Robotics%20Challenge/competition');
//Route::redirect('/oprahat', '/Op.%20Rahat/competition');
//Route::redirect('/OpRahat', '/Op.%20Rahat/competition');
//Route::redirect('/Oprahat', '/Op.%20Rahat/competition');
//Route::redirect('/Op.Rahat', '/Op.%20Rahat/competition');
//Route::redirect('/op.rahat', '/Op.%20Rahat/competition');
//Route::redirect('/Op.rahat', '/Op.%20Rahat/competition');
//Route::redirect('/codecode', '/CoDecode/competition');
//Route::redirect('/meshmerize', '/Meshmerize/competition');
//Route::redirect('/cozmoclench', '/Cozmo%20Clench/competition');
Route::redirect('/CozmoClench', '/Cozmo%20Clench/competition');
Route::redirect('/zero-energy', 'Zero Energy Building/workshop');
Route::redirect('/reforming', '/Reforming%20the%20Past/competition');
Route::redirect('/McCafe', '/McCafe%20On%20the%20Go/competition');
Route::redirect('/Mccafe', '/McCafe%20On%20the%20Go/competition');
Route::redirect('/mccafe', '/McCafe%20On%20the%20Go/competition');
Route::redirect('/mcCafe', '/McCafe%20On%20the%20Go/competition');
//Route::redirect('/boeing', '/Boeing%20Aeromodelling%C2%A0/competition');
//Route::redirect('/aeromodelling', '/Boeing%20Aeromodelling%C2%A0/competition');
//Route::redirect('/Aeromodelling', '/Boeing%20Aeromodelling%C2%A0/competition');
Route::redirect('/zonal', '/technorion');
Route::redirect('/zonals', '/technorion');
//Route::redirect('/fullthrottle', '/International%20Full%20Throttle/competition');
//Route::redirect('/fullthrottle', '/International%20Full%20Throttle/competition');
//Route::redirect('/Full%20Throttle/competition', '/International%20Full%20Throttle/competition');
//Route::redirect('/Full Throttle/competition', '/International%20Full%20Throttle/competition');
//Route::redirect('/FullThrottle', '/International%20Full%20Throttle/competition');
//Route::redirect('/RowBoatics', '/RowBoatics/competition');
//Route::redirect('/events/cyclothon/', '/cyclothon');
Route::redirect('/accomodation', '/accommodation');
Route::redirect('/datathon', '/YES%20BANK%20Datathon/competition');
Route::redirect('/Embedded', 'https://techfest.org/Embedded%20Systems/workshop');
Route::redirect('/DataScience', 'https://techfest.org/Open%20Data%20Science/workshop');
Route::redirect('/ml', '/Machine%20Learning%20in%20Fintech/workshop');
Route::redirect('/ML', '/Machine%20Learning%20in%20Fintech/workshop');
//Route::redirect('/Automobile', 'https://techfest.org/Automobile%20Mechanics/workshop');
Route::redirect('/computer-vision', '/SAMSUNG%20Computer%20Vision/workshop');
Route::redirect('/alexa', '/Voice%20Recognition-%20Alexa/workshop');
Route::redirect('/Nvidia', '/Nvidia Deep Learning/workshop');
Route::redirect('/ChatBot', '/Chat Bot/workshop');
Route::redirect('/ComputerVision', '/SAMSUNG Computer Vision/workshop');
Route::redirect('/CloudComputing', '/Cloud Computing/workshop');
Route::redirect('/matlab', '/Deep Learning using MATLAB/workshop');
Route::redirect('/NanoTech', '/Nano Machine Technology/workshop');
Route::redirect('/DLMATLAB', '/Deep Learning using MATLAB/workshop');
Route::redirect('/summit17', 'https://techfest.org/summit');
Route::redirect('/redirect', 'https://techfest.org/segreta/redirect');
Route::redirect('/All in Cloud/workshop', 'https://techfest.org/Cloud%20Computing/workshop');
//Route::redirect('/GestureRobotics', 'https://techfest.org/Gesture Robotics/workshop');
Route::redirect('/blockchain', 'https://techfest.org/%C2%A0IBM%20Blockchain%20Decentralisation/workshop');
Route::redirect('/ZeroEnergy', 'https://techfest.org/Zero%20Energy%20Building/workshop');
Route::redirect('/Underwater', 'https://techfest.org/Underwater%20Robotics/workshop');

//todo remove the link form url
Route::get('/accommo/123', 'AdminController@workshopDB');
Route::prefix('/ca')->name('ca.')->group(function () {
//    Route::middleware('minify')->group(function () {
//        Route::get('/', 'CaController@indexPost')->name('Get');
//        Route::post('/', 'CaController@indexPost')->name('Post'); //todo remove development and mango from the URL
//        Route::get('/referral', function () {
//            return view('ca.referral');
//        });
//        Route::post('/referral', 'CaController@referralPost');
//    });
    Route::post('/profile', 'CaController@profilePost')->name('profilePost');
    Route::get('/logout', 'CaController@logoutGet')->name('logoutGet');
    Route::post('/upload', 'CaController@uploadPost')->name('uploadPost');
    Route::resource('/event', 'CaEventController');
});
Route::get('/acco/count-all', 'AdminController@accommodation');
Route::get('/payment-test', 'PaymentController@sessionCreate');
Route::prefix('/payment')->name('payment.')->group(function () {
    Route::post('/get-relations', 'PaymentController@getRelations')->name('getRelationsPost');
    Route::get('/direct/{id}', 'PaymentController@directLinks');
});

//Route::get('/twmun/2018', 'EventController@twmunGet');
//Route::get('/robowars', 'EventController@robowarsGet');

Route::get('/innovationchallenge', 'EventController@icGet');
Route::post('/innovationchallenge', 'EventController@icGet');
Route::get('/innovationchallenge/register', 'EventController@icLogin');
Route::get('/innovationchallenge/login', 'EventController@ic_password_Login');
Route::post('/innovationchallenge/login/success', 'EventController@ic_Login_success');
Route::post('/innovationchallenge/post', 'EventController@ic_reg');

Route::get('/initiatives/financial_literacy/test', 'EventController@finlitGet');
Route::post('/initiatives/financial_literacy/test', 'EventController@finlitGet');
Route::get('/initiatives/financial_literacy/login', 'EventController@finlitLogin');
Route::post('/initiatives/financial_literacy/post', 'EventController@finlit_reg');


//Route::get('/cyclothon', 'EventController@cyclothonGet');
//Route::post('/robowars/2018', 'EventController@robowarsPost');
Route::prefix('/2017')->group(function () {
    Route::get('/', 'PreviousController@home')->name('home');
    Route::get('/events/{link}', 'PreviousController@eventsLink')->name('events.link');
    Route::get('/{link}', 'PreviousController@link')->name('link');
});
Route::redirect('/google', 'https://techfest.org/Google%20Android/workshop');
Route::prefix('/android')->group(function () {
    Route::get('qr/{id}', 'Android\MainController@qrGen');
});
//
//Route::domain('m.techfest.org')->name('mobile.')->middleware('minify')->group(function () {
//    Route::get('/', 'MobileController@Get')->name('Get');
////    Route::redirect('/ca','/college-ambassador');
////    Route::get('/ca','CaController@indexPost');
//    Route::get('/404', 'MainController@error404');
//    Route::get('/twmun/2018', 'EventController@twmunGet');
//    Route::get('/robowars', 'EventController@robowarsGet');
//    Route::get('/register', 'MainController@registerUrlGet')->name('registerUrlGet');
//    Route::post('/register', 'MainController@registerUrlPost')->name('registerUrlPost');
//    Route::post('/profile', 'CaController@profilePost')->name('profilePost');
//    Route::get('/{any}', 'MobileController@Get')->name('Get1');
//    Route::get('/{any}/{any2}', 'MobileController@Get')->name('Get2');
//});
Route::get('/admin/accommodation/lock-code/{id}', function ($id) {
    return view('lockCode', compact('id'));
});

Route::redirect('/lookback-18', '/lookback');

//Route::redirect('/CA','/college-ambassador');
//Route::redirect('/CAPortal','/college-ambassador');
//Route::redirect('/Ca','/college-ambassador');
//Route::redirect('/CR','/college-ambassador');
//Route::redirect('/Cr','/college-ambassador');
//Route::redirect('/ca','/college-ambassador');
//Route::redirect('/cr','/college-ambassador');
Route::redirect('/lookback-18', '/lookback');
//
//Route::middleware('minify')->group(function () {
//    Route::get('/', 'MainController@Get')->name('Get');
//    Route::get('/404', 'MainController@error404')->name('error404Get');
//    Route::get('/404-test', 'MainController@error404Test')->name('error404Get');
//    Route::any('/successfully-registered', 'MainController@successfullyRegistered')->name('successfully-registered');
//    //Particular Events Pages
//    //Registrations
//    Route::get('/register', 'MainController@registerUrlGet')->name('registerUrlGet');
//    Route::post('/register', 'MainController@registerUrlPost')->name('registerUrlPost');
//    Route::get('/register/{test?}/{id?}', 'MainController@registerEventGet')->name('registerEventGet');
//    Route::post('/login', 'MainController@loginPost');
//    Route::prefix('/event')->name('event.')->group(function () {
//        Route::get('/get', 'EventController@getPost')->name('getPost');
//        Route::post('/get/{id}', 'EventController@getIdPost')->name('getIdPost');
//    });
//    Route::post('/templatePostUrl', function () {
//        $k = ['category' => 'competition', 'template' => '/2018/competition', 'tags' => 'competition,robowars'];
//        return response()->json($k);
//    })->name('templateUrlPost');
//
//    //General URLs
//    Route::get('/{event}', 'MainController@Get')->name('event');
//    Route::get('/{event}/{eventName}', 'MainController@Get')->name('eventEventName');
//    Route::get('/{event}/{eventName}/{id}', 'MainController@Get')->name('eventEventNameId');
//});


