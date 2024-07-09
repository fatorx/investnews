<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
    <i class="fa fa-sign-in fa-fw"></i>
</button>
