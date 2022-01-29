<?php
//
//namespace Tests\Unit;
//
//use App\Http\Middleware\IsAdmin;
//use Illuminate\Http\Request;
//use App\Models\User;
//use PHPUnit\Framework\TestCase;
//
//class AdminMiddlewareTest extends TestCase
//{
//
//    public function non_admins_are_redirected()
//    {
//        $user = factory(User::class)->make(['is_admin' => false]);
//
//        $this->actingAs($user);
//
//        $request = Request::create('/admin', 'GET');
//
//        $middleware = new IsAdmin;
//
//        $response = $middleware->handle($request, function () {});
//
//        $this->assertEquals($response->getStatusCode(), 302);
//    }
//
//
//
////    public function admins_are_not_redirected()
////    {
////        $user = factory(User::class)->make(['is_admin' => true]);
////
////        $this->actingAs($user);
////
////        $request = Request::create('/admin', 'GET');
////
////        $middleware = new AdminMiddleware;
////
////        $response = $middleware->handle($request, function () {});
////
////        $this->assertEquals($response, null);
////    }
//}
