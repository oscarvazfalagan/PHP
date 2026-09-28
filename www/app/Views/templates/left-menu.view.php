<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo $_ENV['host.folder'] ?>" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'inicio' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php echo (in_array($_SERVER['REQUEST_URI'], [$_ENV['host.folder'] . 'demo-proveedores'])) ? 'menu-open' : '';?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $_ENV['host.folder'] ?>demo-proveedores" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'demo-proveedores' ? 'active' : ''; ?>">
                  <i class="fas fa-laptop-code nav-icon"></i>
                  <p>Demo Proveedores</p>
                </a>
              </li>
                <li class="nav-item <?php echo (in_array($_SERVER['REQUEST_URI'], [$_ENV['host.folder'] . 'demo-proveedores'])) ? 'menu-open' : '';?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Ejercicios-operadores
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php for($i = 0; $i < 11; $i++): ?>
                        <li class="nav-item">
                            <a href="<?php echo $_ENV['host.folder'] ?>ejercicio<?php echo $i+1?>-operadores" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'ejercicio' . $i . '-operadores' ? 'active' : ''; ?>' ?: ''>
                                <i class="fas fa-star-o nav-icon"></i>
                                <p>Ejercicio<?php echo $i+1?>-operadores</p>
                            </a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </li>
                <li class="nav-item <?php echo (in_array($_SERVER['REQUEST_URI'], [$_ENV['host.folder'] . 'demo-proveedores'])) ? 'menu-open' : '';?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Ejercicios-decisiones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php for($i = 0; $i < 7; $i++): ?>
                            <li class="nav-item">
                                <a href="<?php echo $_ENV['host.folder'] ?>ejercicio<?php echo $i+1?>-decisiones" class="nav-link"<?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'ejercicio' . $i . '-decisiones' ? 'active' : ''; ?>' ?: ''>
                                <i class="fa-star-o nav-icon"></i>
                                <p>Ejercicio<?php echo $i+1?>-decisiones</p>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </li>
            </ul>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->