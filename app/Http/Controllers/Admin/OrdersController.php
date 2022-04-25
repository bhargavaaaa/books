<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public $moduleName = "Board";
    public $route = "admin/orders";
    public $view = "admin/orders";

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view ."/index", compact('moduleName'));
    }

    public function getReceivedOrdersData()
    {
        $orders = Order::where('order_state', 0);

        return datatables()->eloquent($orders)
            ->editColumn('order_no',function($order){
                $show = route('orders.show', [encrypt($order->id)]);
                return "<a href=\"{$show}\"><b>{$order->order_no}</b></a>";
            })
            ->editColumn('order_state',function($order){
                return "<select class=\"order_state form-control\">
                    <option value=\"\">Received</option>
                    <option value=\"1\">Shipped</option>
                    <option value=\"4\">Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getShippedOrdersData()
    {
        $orders = Order::where('order_state', 1);

        return datatables()->eloquent($orders)
            ->editColumn('order_no',function($order){
                $show = route('orders.show', [encrypt($order->id)]);
                return "<a href=\"{$show}\"><b>{$order->order_no}</b></a>";
            })
            ->editColumn('order_state',function($order){
                return "<select class=\"order_state form-control\">
                    <option value=\"\">Shipped</option>
                    <option value=\"2\">Delivered</option>
                    <option value=\"4\">Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getDeliveredOrdersData()
    {
        $orders = Order::where('order_state', 2);

        return datatables()->eloquent($orders)
            ->editColumn('order_no',function($order){
                $show = route('orders.show', [encrypt($order->id)]);
                return "<a href=\"{$show}\"><b>{$order->order_no}</b></a>";
            })
            ->editColumn('order_state',function($order){
                return "<select class=\"order_state form-control\">
                    <option value=\"\">Delivered</option>
                </select>";
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getCancelledOrdersData()
    {
        $orders = Order::where('order_state', 3);

        return datatables()->eloquent($orders)
            ->editColumn('order_no',function($order){
                $show = route('orders.show', [encrypt($order->id)]);
                return "<a href=\"{$show}\"><b>{$order->order_no}</b></a>";
            })
            ->editColumn('order_state',function($order){
                return "<select class=\"order_state form-control\">
                    <option value=\"\">Cancelled</option>
                </select>";
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getRejectedOrdersData()
    {
        $orders = Order::where('order_state', 4);

        return datatables()->eloquent($orders)
            ->editColumn('order_no',function($order){
                $show = route('orders.show', [encrypt($order->id)]);
                return "<a href=\"{$show}\"><b>{$order->order_no}</b></a>";
            })
            ->editColumn('order_state',function($order){
                return "<select class=\"order_state form-control\">
                    <option value=\"\">Rejected</option>
                </select>";
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state'])
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        $id = decrypt($id);

        $order = Order::find($id);
        $moduleName = $this->moduleName;
        return view($this->view.'/show', compact('order', 'moduleName'));
    }

    public function stateChange(Request $request, $id)
    {
        $id = decrypt($id);

        $order = Order::find($id);
        $order->order_state = $request->state;
        $order->save();

        if($request->state == 0) {
            $note = " is Received.";
        } elseif ($request->state == 1) {
            $note = " is Shipped."; 
        } elseif ($request->state == 2) {
            $note = " has been Delivered."; 
        } elseif ($request->state == 3) {
            $note = " has been Cancelled."; 
        } elseif ($request->state == 4) {
            $note = " has been Rejected."; 
        }

        OrderHistory::create([
            "order_id" => $id,
            "note" => "Order ".$note
        ]);

        return redirect($this->route);
    }
}
