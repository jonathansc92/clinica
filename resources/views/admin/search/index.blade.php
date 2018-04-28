@extends('admin/layouts/app')
@section('content')


    <page>
        <pagetitlebox size='12' title="Relatório de pesquisas" icon="fa-file"></pagetitlebox>

        <panel size="12">
            <div class="form-group">
                <label>Data</label>
                <div>
                    <div class="input-daterange input-group" id="date-range">
                        <input type="text" class="form-control" name="start">
                        <span class="input-group-addon bg-custom b-0">Até</span>
                        <input type="text" class="form-control" name="end">
                        <button type="submit" value="pesquisar" class="btn btn-success"><i class="fa fa-search"></i> Pesquisar</button>
                    </div>
                </div>
            </div>


        </panel>


    </page>



@endsection