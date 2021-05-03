<h3>@lang('xls.count', ['count' => $count])</h3>

@foreach($results as $filename => $rows)
    <hr>
    <h4>{{ $filename }}</h4>
    <table class="styled-table">
        <tr>
            <th>#</th>
            @foreach(range('A', chr(64 + $rows->first()->count())) as $colChar)
                <th>{{ $colChar }}</th>
            @endforeach
        </tr>

        @foreach($rows as $rowNumber => $columns)
            <tr>
            <td>{{ $rowNumber + 1 }}</td>
            @foreach($columns as $column)
                <td>{{ $column }}</td>
            @endforeach
            </tr>
        @endforeach

    </table>
@endforeach
