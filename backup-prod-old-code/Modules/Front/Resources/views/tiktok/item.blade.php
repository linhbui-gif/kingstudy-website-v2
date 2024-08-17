@if(isset($data))
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm js-copy-text cursor-pointer"  width="300px">
            {{ $data->content  }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white js-copy-text text-sm cursor-pointer" >
            {{ $data->product_name  }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer" >
            <a href="{{ $data->link_video  }}" target="_blank">{{ $data->link_video  }}</a>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 js-copy-text bg-white text-sm cursor-pointer" >
            {{ $data->hash_tag  }}
        </td>
        <td
            class="px-5 py-5 border-b border-gray-200 bg-white text-sm cursor-pointer"
        >
           @if($data->source_chanel == 1)
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Thongminhmart.store</span>
            @elseif($data->source_chanel == 2)
                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">Lina.buishop</span>
            @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Kênh khác</span>
           @endif
        </td>
    </tr>

@endif
