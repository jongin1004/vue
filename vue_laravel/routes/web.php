<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\HttpRequest;
use App\Http\Controllers\ShowProfile;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Psr\Http\Message\ServerRequestInterface;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/home', [HomeController::class, 'index']);

// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register')
//     ]);
// })->name('home');


// Route::redirect('/here', '/there', 301);

// Route::view('/home', 'home', ['name' => 'jongin']);

// //필수 파라미터
// Route::get('/home/{id}', function(Request $request) {
//     return view('home', ['id' => $request->id]);
// });

// Route::get('user/{id}', function ($id) {
//     return 'User '.$id;
// });

//선택적 파라미터, ?를 붙히게되면, 파라미터가 없을 경우에도 에러가 나지 않음 
// Route::get('user/{name?}', function ($name = 'jongin') {
//     return $name;
// });


//where이용해서 파라미터의 포멧을 제한할 수 있다.
//where에는 정규식을 넣어줄 수 있음 ex) [A-Za-z]+, [0-9]+
//또한 ['id' => '[0-9]+', 'name' => '[a-z]+'] 으로 복수개의 파라미터를 정의할 수 있음
// Route::get('user/{id}', function ($id) {
//     return 'User ID :'.$id;
// })->where('id', '[0-9]+');

//RouteServiceProvider.php의 boot()안에 pattern()를 사용하면, Route에서 따로 where로 지정하지 않아도,
//항상 적용되는 포멧을 정의할 수 있다. 
//Route::pattern('id', '[0-9]+'); 을 지정하면, 항상 id 파라미터를 받을 경우에는 해당 정규식이 적용이 된다.
// Route::get('user/{id}', function ($id) {
//     // Only executed if {id} is numeric...
//     return "User ID:".$id;
// });

//name 메소드를 체이닝 하여 라우트에 이름을 지정할 수 있습니다. 라우트 이름은 언제나 고유해야 합니다.
// Route::get('user/profile', function () {
//     return 'name메소드를 지정해서, route함수를 통해 리다이렉션을 생성할 때 route이름을 사용해서 왔다';
// })->name('profile');

//주어진 라우트에 대한 이름이 할당되면, 전역 route 함수를 통해서 URL 또는 리다이렉션을 생성할 때 라우트 이름을 사용할 수 있습니다.
// Route::get('routeName', function () {
//     return redirect()->route('profile');
// });

// Route::get('user/{id}/profile', function ($id) {
//     return "user id :".$id;
// })->name('profile');

//route()함수에 파라미터도 같이 보낼 수 있으며, 배열형태로 여러개의 파라미터를 전달할 수도있다. 
//이때, 기존 name()된 라우터에서 파라미터가 지정되어있지 않은  초과된 파라미터는 
//URL에 쿼리문형태로 추가되어진다. /user/1/profile?photos=yes
// Route::get('routeName', function () {
//     return redirect()->route('profile', ['id' => 1, 'photos' => 'yes']);
// });

//라우트 그룹
//그룹을 사용하면, 라우트마다 미들웨어를 지정해주지 않아도 된다. 
// Route::middleware(['first', 'second'])->group(function () {
//     Route::get('/', function () {
//         // Uses first & second middleware...
//     });

//     Route::get('user/profile', function () {
//         // Uses first & second middleware...
//     });
// });

//prefix를 이용하면, url접두사가 되는 것을 지정해줄 수 있다.
// Route::prefix('admin')->group(function () {
//     //admin/users
//     Route::get('users', function () {
//         return "USERS";
//     });
//     //admin/group
//     Route::get('group', function () {
//         return "GROUP";
//     });
// });

//name(".")을 사용하면, route의 name()을 지정할때 해당 접두사를 지정해줄 수 있다.
// Route::name('admin.')->group(function () {
//     Route::get('users', function () {
//         return "USERS";
//     })->name('users'); // = name('admin.users')

//     Route::get('group', function () {
//         return "GROUP";
//     })->name('group'); = name('admin.group')
// });

// Route::get('abc', function() {
//     return redirect()->route('admin.group');
// });

// request URI 로 부터 일치하는 ID 값을 가진 모델 인스턴스를 주입할것입니다. 
//만약 데이터베이스에서 매칭되는 모델 인스턴스를 찾을 수 없으면, 자동으로 404 HTTP response 가 생성됩니다.
// Route::get('user/{name}', function (User $user) {
//     return $user->email;
// });

//id값이 아니라 다른 컬럼으로 사용하길 원한다면, 지정해줄 수도 있다.
// Route::get('api/posts/{post:slug}', function (App\Post $post) {
//     return $post;
// });

//대체하는 라우트가 없을 때 실행할 라우트를 정의할 수 있다. 
// Route::fallback(function() {
//     return view('home');
// });


// Request요청의 최대치를 정할 수 있다.
//throttle() 를 사용해서 throttle(60, 1) -> 1분에 60개로 제한한다는 의미 
////User 모델에 rate_limit라는 속성이 있으먄, thrpttle(rate_limit, 1)로 동적인 제한도 가능
// Route::middleware('auth:api', 'throttle:3,1')->group(function () {
//     Route::get('/user', function () {
//         return view('home');
//     });
// });

//게스트 사용자와 인증된 사용자를 다른 Rate로 제한해줄 수 있다.
// "|" 를 기준으로 왼쪽은 게스트 Rate, 오른쪽은 인증된 사용자의 Rate
// "throttle:10|60. 1"은 1분동안 게스트는 10개의 Rate, 인증된 사용자는 60개의 Rate라는 의미
// Route::middleware('throttle:5|60,1')->group(function () {
//     Route::get('/test', function() {
//         return "throttle 5번 제한";
//     });
// });



//미들웨어
//미들웨어는 HTTP요총이 애플리케이션에 도달하기 전에 반드시 통과해야하는 일종의 단계이다.
// HTTP요청을 미들웨어 처리전에 실행할지, 처리후에 실행할지는 미들웨어에서 결정할 수 있다

//app/Http/Kernel.php에서 전역 미들웨어를 설정해 줄 수 있다.

Route::get('admin/profile', function () {
    //
})->middleware('auth'); // auth는 Kernel.php에서 지정해놓은 이름이다.
//지정해놓은 이름을 사용하지 않고, 전체 클레스 이름으로도 전달가능 ex) middelware(CheckAge::class);

//그룹을 통해서 미들웨어를 적용할 수 도 있고 
Route::middleware([CheckAge::class])->group(function () {
    Route::get('/', function () {
        //
    });

    Route::get('admin/profile', function () {
        //
    })->withoutMiddleware([CheckAge::class]); //그룹내에 미들웨어를 적용시키면 안되는 부분은 withoutMiddelware 사용
});

//Kernel.php에는 middlewareGroups라고 정의되어있어, 그곳에서 하나의 미들웨어 이름으로 다양한 미들웨어를 적용가능
// 'web' => [
//         \App\Http\Middleware\EncryptCookies::class,
//         \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//         \Illuminate\Session\Middleware\StartSession::class,
//         \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//         \App\Http\Middleware\VerifyCsrfToken::class,
//         \Illuminate\Routing\Middleware\SubstituteBindings::class,
//     ],
//web이라는 이름으로 다양한 미들웨어를 적용한것을 볼 수 있다. 

// Route::get('/', function () {
//     //
// })->middleware('web');

// Route::group(['middleware' => ['web']], function () {
//     //
// });

// Route::middleware(['web', 'subscribed'])->group(function () {
//     //
// });


//미들웨어 순서
//Kernel.php에서 middlewarePriority속성을 사용하여 우선순위를 지정 가능하다. 


//미들웨어 인자
// Route::put('post/{id}', function ($id) {
//     //
// })->middleware('role:editor'); //":"로 구분한다.  middleware(미들웨어 이름 : 인자)



//컨트롤러
//컨트롤러는 기본 클래스를 확장하기 위해 필수가 아닙니다. 
//그러나 middleware, validate, dispatch 함수와 같은 편리한 기능을 사용할 수는 없습니다.
// Route::get('user/{id}', [UserController::class, 'show']);


//단일 동작 컨트롤러
//단일 액션 컨트롤러에 대한 경로를 등록할 때 함수를 지정할 필요가 없다. 
// Route::get('user/{id}', ShowProfile::class);

//컨트롤러에서 미들웨어 지정



//리소스 컨트롤러
//php artisan make:controller PhotoController --resource 명령어를 사용하면,
//컨트롤러를 생성할 때, CRUD에 필요한 함수의 틀을 자동적으로 생성해준다.

//resource를 사용하면, 한번의 선언만으로 photo 를 구성하는 RESTful 한 액션에 대한 다양한 라우트를 설정할 수 있습니다.
// Route::resource('photos', PhotoController::class);

//배열을 사용해서, 여러개의 리소스 컨트롤러를 등록할 수 있다.
// Route::resources([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ]);

//액션의 일부만 지정해줄 수도 있다.
// Route::resource('photos', PhotoController::class)->except([
//     'create', 'store', 'update', 'destroy'
// ]);

//중첩된 리소스
// /때때로 중첩 된 리소스에 대한 라우트를 정의해야 할 수도 있습니다. 
//예를 들어, 사진 리소스는 사진에 첨부 될 수있는 다수의 코멘트를 가질 수 있습니다. 
//리소스 컨트롤러를 중첩하려면 경로 선언에서 "점-dot"표기법을 사용하십시오.
// Route::resource('photos.comments', PhotoCommentController::class);

// 위의 라우트는 /photos/{photo}/comments/{comment} URL로 접근할 수 있는 중첩된 리소스 제공

//scoped 메서드를 사용해 중첩 된 리소스를 정의 할 때 자동 범위 지정을 활성화 할 수있을뿐만 아니라
//Laravel에 하위 리소스를 검색해야하는 필드를 지정할 수 있습니다.
// Route::resource('photos.comments', PhotoCommentController::class)->scoped([
//     'comment' => 'slug',
// ]);

//이 라우트는 다음과 같은 URI로 접근해 중첩된 리소스의 범위를 지정 등록할 수 있습니다.
// /photos/{photo}/comments/{comment:slug}


//얕은 중첩
//자식 ID는 이미 고유 식별자이므로 URI 내에 부모 ID와 자식 ID를 모두 가질 필요는 없습니다. 
// Route::resource('photos.comments', CommentController::class)->shallow();

//리소스 라우트 이름 지정하기
//기본적으로 모든 리소스 컨트롤러 액션은 라우트 이름을 가지고 있습니다. 그러나 names 옵션 배열을 전달하여 이름을 덮어씌울 수 있습니다.
// Route::resource('photos', PhotoController::class)->names([
//     'create' => 'photos.build'
// ]);

//리소스 라우트 파리미터 이름 지정하기
Route::resource('users', AdminUserController::class)->parameters([
    'users' => 'admin_user'
]);

//위의 예제는  /users/{admin_user}

//Resource 컨트롤러 라우트에 추가하기
//만약 리소스 컨트롤러에 추가적으로 라우팅을 구성해야할 필요가 있다면
// Route::resource가 호출되기 전에 등록해야합니다. 그렇지 않으면 resource 메소드에
// 의해서 정의된 라우트들이 추가한 라우트들 보다 우선하게 되어 버립니다.
Route::get('photos/popular', [PhotoController::class, 'popular']);
Route::resource('photos', PhotoController::class);

//라우트 캐시
//컨트롤러 기반의 라우드만을 사용할 경우, 라이트 캐시를 사용하게되면, 
//라우트등록이 100배 빨라질 수도 있다.
// php artisan route:cache 명령어 사용
//이 명령을 실행하면 캐시 된 라우트 파일이 모든 요청에 로드됩니다. 
//새로운 라우트를 추가하는 경우 새로운 라우트 캐시를 생성해야합니다. 
//이 때문에 프로젝트 배포 중에 route:cache 명령 만 실행하면 됩니다.

//캐시를 재생성하는것 말고 캐시를 제거하기 위해서는 route:clear 명령어를 실행하면 됩니다.
//php artisan route:clear


//HTTP Request
// Route::get('/http/aaa', [HttpRequest::class, 'path']);

// Route::get('/http/aaa', [HttpRequest::class, 'path_is']);

// Route::get('/http/aaa', [HttpRequest::class, 'url']);

// Route::get('/http/aaa', [HttpRequest::class, 'method']);

// Route::get('/http', function (ServerRequestInterface $request) {
//     return $request;
// });

// Route::get('/http', [HttpRequest::class, 'all']);

// Route::get('/http', [HttpRequest::class, 'input']);

// Route::get('/http', [HttpRequest::class, 'query']);

// Route::get('/http', [HttpRequest::class, 'boolean']);

// Route::get('/http', [HttpRequest::class, 'onlyAndExcept']);

// Route::get('/http', [HttpRequest::class, 'has']);

// Route::get('/http', [HttpRequest::class, 'cookie']);

Route::post('/away', function () {
    // Validate the request...

    // return back()->withInput();
    // //route 메소드를 사용할 수 있습니다.
    // return redirect()->route('login');
    // //라우트가 인자를 받아야 한다면, route 메소드의 두번째 인자로 이를 전달할 수 있습니다.
    // return redirect()->route('profile', ['id' => 1]);
    //Eloquent 모델에 의해서 채워지는 "ID" 파라미터를 가진 라우트로 리다이렉트 하는 경우, 
    //모델 그 자체를 전달할 수 있습니다. ID 는 자동으로 추출됩니다.
    // return redirect()->route('home', [$user]);

    //또한 컨트롤러 액션으로 리다이렉트하는 응답을 생성할 수도 있습니다. 이렇게 하기 위해서는,
    // 컨트롤러와 액션의 이름을 action 메소드에 전달하면 됩니다.
    // return redirect()->action([HomeController::class, 'index']);
    //컨트롤러 라우트에 파라미터가 필요한 경우, action 메소드의 두 번째 인자로 전달하면 됩니다.
    // return redirect()->action(
    //     [UserController::class, 'profile'], ['id' => 1]
    // );

    //때로는 애플리케이션의 외부 도메인으로 리다이렉트 해야 하기도 합니다. 
    //추가적인 URL 인코딩, 유효성 검사와 확인 과정 없이 RedirectResponse을 만드는 away 메소드를 호출해서 이렇게 할 수 있습니다.
    // return redirect()->back();

    //away()를 이용해서 URL인토딩, 유효성 검사없이 외부 도메인으로 리다이렉트 
    return redirect()->away('https://www.google.com');
})->name('google');

Route::get('/test', function(){
    return view('test');
});

Route::get('/home', function () {
    return view('home');
});

//성공 메세지를 세션에 임시 저장할 때 작업을 성공적으로 액션을 수행한 다음에 완료
//인스턴스를 생성하고 데이터를 세션에 임시저장하는 유연한 메소드 체이닝을 할 수 있습니다.
Route::post('user/status', function () {
    return redirect('home')->with('status', 'Profile updated!');
})->name('status');

Route::get('/view', function () {
    
    //exist 메소드는 뷰 파일이 존재한다면 true 를 반환할 것입니다.
    if (View::exists('emails.customer')) {
        return view('home');
    }

    //first 메소드를 사용하면, 주어진 배열에 있는 뷰 중에서 
    //사용가능한 처음의 뷰를 사용 할 수 있습니다. 
    // return view()->first(['xxxx', 'test', 'home', 'bbbb']);
    //View 파사드를 통해서도 이 메소드를 호출할 수 있습니다.
    // return View::first(['custom.admin', 'admin'], $data);

    //with 메소드를 사용하여 뷰에 전달할 데이터를 개별적으로 추가 할 수도 있습니다.
    //아래의 코드와 똑같은 코드다 return view('home', ['name' => 'Victoria']);
    return view('home')->with('name', 'Victoria');
});

//모든 뷰파일에서 데이터 공유하기
//모든 뷰에서 데이터를 공유할 필요가 있을 수도 있습니다. 
//여러분은 뷰 파사드의 share 메소드를 사용하면 됩니다.
//AppServiceProvider.php의 boot()메소드에 구성해야한다. 
// use Illuminate\Support\Facades\View;

// public function boot()
//     {
//         View::share('key', 'value');
//     }


Route::get('/profile', function() {
    return view('profile');
});


Route::get('/test/{id?}', function () {
    //
})->name('unsubscribe');

Route::get('/test/{post}/comment/{comment}', function () {
    //
})->name('comment.show');

//유입되는 request-요청이 유효한 서명이 있는지 확인하기 위해서는 
//유입되는 Request 에 hasValidSignature 메소드를 호출해야 합니다.
Route::get('/unsubscribe/{user}', function (Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }

    // ...
})->name('unsubscribe');

//또한 ValidateSignature(signed) 미들웨어를 사용하여 검사할 수도 있다.
//유입되는 request-요청에 유효한 서명이 없다면, 
//미들웨어는 자동으로 403 오류 response-응답을 반환합니다.
Route::post('/unsubscribe/{user}', function (Request $request) {
    // ...
})->name('unsubscribe')->middleware('signed');


Route::get('/action', function() {
    $url = action([HomeController::class, 'index']);

    return view('home', ['url' => $url]);
});



//몇몇 애플리케이션에서는 특정 URL 파라미터에 대해 요청-reqeust 전의 기본값을 지정할 수 있습니다.
// 예를 들어, 다수의 라우트에서 {locale} 파라미터를 정의한다고 가정해보겠습니다
Route::get('/{locate}/user', function () {
    //
})->name('user.index');

//route 헬퍼를 호출할 때마다 locale 을 전달해야 하는 것은 번거로운 일일 수 있습니다. 
//따라서 URL::defaults 메소드를 사용하여 현재 요청-request 중에서 항상 적용될 파라미터의 
//기본값을 정의 할 수 있습니다. 라우트 미들웨어에서 이 메소드를 호출하여 현재의 요청-request에 엑
//세스 할 수 있습니다.

// 주의할점!! -> middleware에 URL::defaults 작성한뒤에 꼭, Kernel.php에서 전역 미들웨어에 등록하기
//URL 기본값을 설정하면 라라벨의 묵시적 모델 바인딩 처리에 방해가 될 수 있습니다. 
//따라서, 라라벨의 SubstituteBindings 미들웨어 이전에 URL 기본값을 설정한 미들웨어를 실행해야 합니다.
// 애플리케이션 HTTP 커널의 $middlewarePriority 속성 내에서 SubstituteBindings 보다 먼저 등록되어야합니다.