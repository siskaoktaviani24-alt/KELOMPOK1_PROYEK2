<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display home page
     */
    public function index()
    {
        return view('frontend.home');
    }
    
    /**
     * Calculate Newton Raphson
     */
    public function calculateNewtonRaphson(Request $request)
    {
        $request->validate([
            'function' => 'required|string',
            'initial_guess' => 'required|numeric',
            'tolerance' => 'required|numeric'
        ]);
        
        $function = $request->function;
        $x0 = $request->initial_guess;
        $tolerance = $request->tolerance;
        
        // Implement Newton Raphson calculation here
        $results = $this->newtonRaphsonCalculation($function, $x0, $tolerance);
        
        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }
    
    /**
     * Newton Raphson Calculation Logic
     */
    private function newtonRaphsonCalculation($function, $x0, $tolerance)
    {
        // Example implementation - you need to adapt this
        $iterations = [];
        $x = $x0;
        $iteration = 0;
        
        do {
            // Calculate f(x) and f'(x)
            $fx = $this->evaluateFunction($function, $x);
            $fpx = $this->evaluateDerivative($function, $x);
            
            // Avoid division by zero
            if (abs($fpx) < 0.0000001) {
                break;
            }
            
            $x_new = $x - ($fx / $fpx);
            $fx_new = $this->evaluateFunction($function, $x_new);
            
            $iterations[] = [
                'iteration' => $iteration,
                'x1' => round($x, 6),
                'fx1' => round($fx, 6),
                'fpx1' => round($fpx, 6),
                'x2' => round($x_new, 6),
                'fx2' => round($fx_new, 6),
                'abs_fx2' => round(abs($fx_new), 6),
                'status' => abs($fx_new) <= $tolerance ? 'STOP' : 'LANJUT'
            ];
            
            $x = $x_new;
            $iteration++;
            
        } while (abs($fx_new) > $tolerance && $iteration < 50);
        
        return $iterations;
    }
    
    /**
     * Evaluate function at point x
     */
    private function evaluateFunction($function, $x)
    {
        // Replace 'x' with the value in the function string
        $expression = str_replace('x', $x, $function);
        
        // Very basic evaluation - you might want to use a proper expression evaluator
        // This is a simplified version and might not work for all functions
        try {
            return eval("return $expression;");
        } catch (\Throwable $th) {
            return 0;
        }
    }
    
    /**
     * Evaluate derivative at point x (numerical differentiation)
     */
    private function evaluateDerivative($function, $x)
    {
        $h = 0.0001; // Small step
        $fx_plus = $this->evaluateFunction($function, $x + $h);
        $fx_minus = $this->evaluateFunction($function, $x - $h);
        
        return ($fx_plus - $fx_minus) / (2 * $h);
    }
}