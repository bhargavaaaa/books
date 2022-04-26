<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public $moduleName = "Orders";
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
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Received</option>
                    <option value=\"1\">Shipped</option>
                    <option value=\"4\">Rejected</option>
                </select>";
            })
            ->editColumn('order_item_ids',function($order) {
                $items = Product::whereIn('id', json_decode($order->order_item_ids, true))->pluck('product_name')->toArray();
                return substr(implode(", ", $items), 0, 100).'...';
            })
            ->editColumn('order_item_quantities',function($order) {
                $items = json_decode($order->order_item_quantities, true);
                return array_sum($items);
            })
            ->editColumn('main_total',function($order) {
                return "₹ ".$order->main_total;
            })
            ->editColumn('payment_method',function($order) {
                return ucfirst($order->payment_method);
            })
            ->editColumn('created_at',function($order) {
                return date('d-M-Y', strtotime($order->created_at));
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state', 'order_item_ids', 'order_item_quantities', 'main_total', 'created_at'])
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
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Shipped</option>
                    <option value=\"2\">Delivered</option>
                    <option value=\"4\">Rejected</option>
                </select>";
            })
            ->editColumn('order_item_ids',function($order) {
                $items = Product::whereIn('id', json_decode($order->order_item_ids, true))->pluck('product_name')->toArray();
                return substr(implode(", ", $items), 0, 100).'...';
            })
            ->editColumn('order_item_quantities',function($order) {
                $items = json_decode($order->order_item_quantities, true);
                return array_sum($items);
            })
            ->editColumn('main_total',function($order) {
                return "₹ ".$order->main_total;
            })
            ->editColumn('payment_method',function($order) {
                return ucfirst($order->payment_method);
            })
            ->editColumn('created_at',function($order) {
                return date('d-M-Y', strtotime($order->created_at));
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state', 'order_item_ids', 'order_item_quantities', 'main_total', 'created_at'])
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
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Delivered</option>
                </select>";
            })
            ->editColumn('order_item_ids',function($order) {
                $items = Product::whereIn('id', json_decode($order->order_item_ids, true))->pluck('product_name')->toArray();
                return substr(implode(", ", $items), 0, 100).'...';
            })
            ->editColumn('order_item_quantities',function($order) {
                $items = json_decode($order->order_item_quantities, true);
                return array_sum($items);
            })
            ->editColumn('main_total',function($order) {
                return "₹ ".$order->main_total;
            })
            ->editColumn('payment_method',function($order) {
                return ucfirst($order->payment_method);
            })
            ->editColumn('created_at',function($order) {
                return date('d-M-Y', strtotime($order->created_at));
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state', 'order_item_ids', 'order_item_quantities', 'main_total', 'created_at'])
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
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Cancelled</option>
                </select>";
            })
            ->editColumn('order_item_ids',function($order) {
                $items = Product::whereIn('id', json_decode($order->order_item_ids, true))->pluck('product_name')->toArray();
                return substr(implode(", ", $items), 0, 100).'...';
            })
            ->editColumn('order_item_quantities',function($order) {
                $items = json_decode($order->order_item_quantities, true);
                return array_sum($items);
            })
            ->editColumn('main_total',function($order) {
                return "₹ ".$order->main_total;
            })
            ->editColumn('payment_method',function($order) {
                return ucfirst($order->payment_method);
            })
            ->editColumn('created_at',function($order) {
                return date('d-M-Y', strtotime($order->created_at));
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state', 'order_item_ids', 'order_item_quantities', 'main_total', 'created_at'])
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
                return "<select class=\"order_state form-control\" data-id=\"".encrypt($order->id)."\">
                    <option value=\"NAN\">Rejected</option>
                </select>";
            })
            ->editColumn('order_item_ids',function($order) {
                $items = Product::whereIn('id', json_decode($order->order_item_ids, true))->pluck('product_name')->toArray();
                return substr(implode(", ", $items), 0, 100).'...';
            })
            ->editColumn('order_item_quantities',function($order) {
                $items = json_decode($order->order_item_quantities, true);
                return array_sum($items);
            })
            ->editColumn('main_total',function($order) {
                return "₹ ".$order->main_total;
            })
            ->editColumn('payment_method',function($order) {
                return ucfirst($order->payment_method);
            })
            ->editColumn('created_at',function($order) {
                return date('d-M-Y', strtotime($order->created_at));
            })
            ->addColumn('action',function($order){
                $showUrl = route('orders.show', [encrypt($order->id)]);
                return "<a href='" . $showUrl . "' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View Order</a>";
            })
            ->rawColumns(['action', 'order_no', 'order_state', 'order_item_ids', 'order_item_quantities', 'main_total', 'created_at'])
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

    public function stateChange(Request $request)
    {
        $id = decrypt($request->id);

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

        return response()->json(["status" => true], 200);
    }
}
