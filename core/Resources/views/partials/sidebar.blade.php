@php use Fanintek\Fantasena\Models\FanMenu; @endphp

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <section class="sidebar">
    @php $menus = buildTree(FanMenu::all()->toArray()); @endphp

    {!! buildMenu($menus) !!}
  </section>
  <!-- /.sidebar -->
</aside>