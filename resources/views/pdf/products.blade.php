@include('pdf.master')
<body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div>
                        {{$item->name}}
                        {{ htmlspecialchars($item->description)  }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
