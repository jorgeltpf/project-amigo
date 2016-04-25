<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;

use App\AssignedRoles;

class Admin implements Middleware {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth,
                                ResponseFactory $response) {
        $this->auth = $auth;
        $this->response = $response;
    }

    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            if ($this->auth->user()->hasRole(['establishment', 'establishment_operator'])) {
                $request->session()->put('establishment', $this->auth->user()->getUserEstablishmentId($this->auth->user()->id));
                $request->session()->put('person', $this->auth->user()->getUserPersonId($this->auth->user()->id));
            }

            if (!$this->auth->user()->hasRole(['admin', 'establishment', 'establishment_operator'])
                // || !$this->auth->user()->isAuthorized($request->route()->parameter('id'), $this->auth->user()->id)
            ) {
                return $this->response->redirectTo('/');
            }
            return $next($request);
        }
        return $this->response->redirectTo('/');
	}

}
