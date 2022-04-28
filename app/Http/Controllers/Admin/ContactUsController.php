<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public $moduleName = 'Contact Us';
    public $route = 'admin/contact_us';
    public $view = 'admin/contact_us';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view . '/index', compact('moduleName'));
    }

    public function getContactUsData()
    {
        $contactUs = ContactUs::select();

        $datatables = datatables()->eloquent($contactUs)
            ->editColumn('message', function ($row) {
                return substr($row->message, 0, 100);
            })
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalScrollable' . $row->id . '">
                    View
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalScrollable' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        ' . $row->message . '
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                ';
                return $action;
            })
            ->rawColumns(['action', 'message'])
            ->addIndexColumn()
            ->make(true);

        return $datatables;
    }
}
