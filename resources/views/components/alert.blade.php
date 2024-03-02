<div id="alert" {{ $attributes }}>
    {{ $slot }}
</div>
<style>
    #alert {
        width: 100%;
        padding: 5px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f8d7da;
    }

    #alert.danger {
        background-color: #fff2f2;
    }

    #alert.info {
        background-color: #f2f2ff;
        color: blue;
    }
</style>
