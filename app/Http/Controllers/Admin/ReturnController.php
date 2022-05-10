<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ReturnHistory;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public $moduleName = "Return Orders";
    public $route = "admin/return-orders";
    public $view = "admin/return";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view ."/index", compact('moduleName'));
    }

    public function getRequestRegisteredData()
    {
        $orders = ReturnOrder::where('status', 0);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Request Registered</option>
                    <option value=\"1\">Request Accepted</option>
                    <option value=\"2\">Request Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getRequestAcceptedData()
    {
        $orders = ReturnOrder::where('status', 1);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Request Accepted</option>
                    <option value=\"3\">Return Taken</option>
                </select>";
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getRequestRejectedData()
    {
        $orders = ReturnOrder::where('status', 2);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Request Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getReturnTakenData()
    {
        $orders = ReturnOrder::where('status', 3);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Return Taken</option>
                    <option value=\"4\">Return Accepted</option>
                    <option value=\"5\">Return Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getReturnAcceptedData()
    {
        $orders = ReturnOrder::where('status', 4);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                $html = "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Return Accepted</option>";
                    if($order->need == 0) {
                        $html .= "<option value=\"7\">Replacement Given</option>";
                    } else {
                        $html .= "<option value=\"6\">Cashback Given</option>";
                    }
                $html .= "</select>";
                return $html;
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getReturnRejectedData()
    {
        $orders = ReturnOrder::where('status', 5);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                $html = "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Return Rejected</option>";
                $html .= "</select>";

                return $html;
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getCashbackGivenData()
    {
        $orders = ReturnOrder::where('status', 6);
        
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                $html = "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Cashback Given</option>";
                $html .= "</select>";

                return $html;
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getReplacementGivenData()
    {
        $orders = ReturnOrder::where('status', 7);
        return datatables()->eloquent($orders)
            ->editColumn('order_id',function($order){
                $orderData = Order::where("id", $order->order_id)->first();
                $show = route('orders.show', [encrypt($orderData->id)]);
                return "<a href=\"{$show}\"><b>{$orderData->order_no}</b></a>";
            })
            ->editColumn('need',function($order){
                if($order->need == 0) {
                    return "Replacement";
                } else {
                    return "Cashback";
                }
            })
            ->editColumn('problem',function($order) {
                return substr($order->problem, 0, 100).'...';
            })
            ->editColumn('status',function($order) {
                $html = "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Replacement Given</option>";
                $html .= "</select>";

                return $html;
            })
            ->addColumn('action',function($order) {
                return "<a href='javascript:;' class='btn btn-primary btn-xs' data-desctiption=\"{$order->problem}\"><i class='fa fa-eye'></i> View Full Problem</a>";
            })
            ->rawColumns(['order_id', 'need', 'problem', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function stateChange(Request $request)
    {
        $id = decrypt($request->id);

        $order = ReturnOrder::find($id);
        $order->status = $request->state;
        $order->save();

        if($request->state == 0) {
            $note = " Request Registered.";
        } elseif ($request->state == 1) {
            $note = " Request Accepted.";
        } elseif ($request->state == 2) {
            $note = " Request Rejected.";
        } elseif ($request->state == 3) {
            $note = " Return Taken.";
        } elseif ($request->state == 4) {
            $note = " Return Accepted.";
        } elseif ($request->state == 5) {
            $note = " Return Rejected.";
        } elseif ($request->state == 6) {
            $note = " Cashback Given.";
        } elseif ($request->state == 7) {
            $note = " Given.";
        }

        ReturnHistory::create([
            "return_id" => $id,
            "note" => "Replacement ".$note
        ]);

        return response()->json(["status" => true], 200);
    }
}
