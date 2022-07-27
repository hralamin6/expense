@include('pdf.master')
<body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th wire:click.prevent="FilterSerialize('name')">Name</th>
                                    <th wire:click.prevent="FilterSerialize('status')">Status</th>
                                </tr>
                                </thead>
                                <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                <tbody>
                                @forelse($products->reverse() as $key=>$product)
                                    <tr  wire:key="row-{{ $product->id }}">
                                        <td class="text-capitalize"><a href="{{route('dashboard.products')}}">{{ $product->name }}</a></td>
                                        <td><span class="text-capitalize" style="{{ $product->status=='active'?'color:green':'color:red'}}">{{ $product ->status }}</span></td>
                                    </tr>
                                @empty
                                    <th class="text-center" colspan="11">No products found</th>
                                @endforelse
                                </tbody>
                            </table>
                            <h5>Signature:</h5>
                            <div>Date: <span>{{ date('d.m.Y H:i:s')}}</span></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
