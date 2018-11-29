<div class="sidebar" data-color="orange">
    <div class="logo">
        <h3 style=" font-family: 'roboto', cursive;
                color: #ffffff;
                margin-top: 10px;
                margin-left: 30px;
                padding-top: 10px;">SISDEPE</h3>

    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">            
            <li class="@yield('musuario')">
                <a href="/users">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="@yield('mcurso')">
                 <a href="/courses">
                     <i class="fa fa-book"></i>
                     <p>Cursos</p>
                 </a>
            </li>           
            <li class="@yield('mdemandas')">
                <a href="/demandas">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>Demandas</p>
                </a>
            </li>
            <li class="@yield('mtipodemandas')">
                <a href="/typesofocurrences">
                    <i class="now-ui-icons shopping_tag-content"></i>
                    <p>Tipos de Ocorrências</p>
                </a>
            </li>          
            <li class="@yield('mprojetos')">
                <a href="/projetos">
                    <i class="now-ui-icons design-2_ruler-pencil"></i>
                    <p>Projetos</p>
                </a>
            </li>
            <li class="@yield('mrelatorios')">
                <a href="/relatorios">
                    <i class="now-ui-icons education_paper"></i>
                    <p>Relatorios</p>
                </a>
            </li>
        </ul>
    </div>
</div>
