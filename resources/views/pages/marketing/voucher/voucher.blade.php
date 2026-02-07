@extends('layouts/marketing-template')

@vite(['resources/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css', 'resources/assets/vendor/remixicon/fonts/remixicon.css'])


@section('marketing-content')
    <div class="w-full px-4">
        <a href="{{ route('voucher.create') }}">
            <div class='bg-green-400 hover:bg-green-500 px-4 py-2 rounded text-center w-fit text-white mb-3 cursor-pointer'>
                <span>Tambah Data</span>
            </div>
        </a>
        <div class="row">
            <div class="table-responsive rounded mb-3">
                <table class="data-tables table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>Insurance Name</th>
                            <th>Discount</th>
                            <th>Max Discount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->insurances->name }}</td>
                                @if ($item->discount_type == 'percent')
                                    <td>{{ $item->discount_value }}%</td>
                                @else
                                    <td>Rp.{{ number_format($item->discount_value) }}</td>
                                @endif
                                <td>
                                    {{ $item->max_discount <= 0 ? 'NO MAX' : 'Rp. ' . number_format($item->max_discount) }}
                                </td>

                                <td>{{ $item->end_date ? $item->start_date : 'UNLIMITED' }}</td>
                                <td>{{ $item->end_date ? $item->end_date : 'UNLIMITED' }}</td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="Edit"
                                            href="{{ route('voucher.edit', ['voucher' => $item->id]) }}"><i
                                                class="ri-pencil-line mr-0"></i></a>
                                        <a href="javascript:void(0)" class="badge bg-warning mr-2"
                                            onclick="confirmDelete({{ $item->id }})" data-toggle="tooltip"
                                            title="Delete">
                                            <i class="ri-delete-bin-line mr-0"></i>
                                        </a>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('voucher.destroy', $item->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete(id) {
            if (confirm('Yakin ingin menghapus voucher ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
