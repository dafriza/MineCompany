<?php

namespace App\DataTables\OrderVehicle;

use App\Models\ApprovalTable;
use App\Models\VehicleOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderVehicleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        
        $generateDataTable = (new EloquentDataTable($query))
            ->addColumn('driver', function(VehicleOrder $vehicleOrder) {
                return $vehicleOrder->driver->name;
            })
            ->addColumn('start', function(VehicleOrder $vehicleOrder) {
                return $vehicleOrder->start_formatted;
            })
            ->addColumn('end', function(VehicleOrder $vehicleOrder) {
                return $vehicleOrder->end_formatted;
            })
            ->addColumn('status', function(VehicleOrder $vehicleOrder) {
                return $vehicleOrder->status_order;
            })
            ->setRowId('id')
            ;

            if($this->isApprovalRole()) {
                $generateDataTable = $generateDataTable->addColumn('action', function(VehicleOrder $vehicleOrder) {
                    return view('Approval.components.action', compact('vehicleOrder'))->render();
                });
            }

        return $generateDataTable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VehicleOrder $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('approvaltable-table')
                    ->setTableHeadClass('approvaltable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('order_vehicle.index'))
                    // ->dom('flrtip')
                    ->orderBy(0, 'asc')
                    ->selectStyleSingle()
                    // ->buttons([
                    //     // Button::make('excel'),
                    //     // Button::make('csv'),
                    //     // Button::make('pdf'),
                    //     // Button::make('print'),
                    //     Button::make('reload'),
                    // ])
                    ;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id')->orderable(true),
            Column::make('order_id'),
            Column::make('driver'),
            Column::make('start'),
            Column::make('end'),
            Column::make('status'),
        ];

        if($this->isApprovalRole()) {
            $newColumn = Column::make('action');
            array_push($columns, $newColumn);
        }

        return $columns;
    }
    
    private function isApprovalRole() : bool {
        $user = auth()->user();
        
        return $user->is_approval_role;
    }
}
