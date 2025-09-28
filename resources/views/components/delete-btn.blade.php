@props([
    'route',
    'id',
    'method' => 'DELETE',
    "classList" => "btn btn-danger btn-sm"
])

<button
    type="button"
    data-href="{{ $route }}"
    data-id="{{ $id  }}"
    data-method="{{ $method  }}"
    class="erase {{ $classList }}"
    href="javascript:void(0);">
    <i data-feather="trash" class="icon-14"></i> {{ $slot }}
</button>
