<style>
    .breadcrumb-item+.breadcrumb-item::before {
        float: {{ lang('ar') ? 'right': 'left' }};
    }
    
    .ribbon {
        {{ lang('ar') ? 'right': 'left' }}: -40px;
        -webkit-transform: rotate({{ lang('ar') ? '45deg': '315deg' }});
    }
</style>
