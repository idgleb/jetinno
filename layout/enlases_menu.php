<!-- enlases_menu.php -->
<a class=" mb-3 " href="index.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 17 17">
        <path fill-opacity=".8" d="M8 3.293l6 6V15H2V9.293l6-6zM1 8.293v7a1 1 0 0 0 1 1h5v-4h2v4h5a1 1 0 0 0 1-1v-7L8 1.293 1 8.293z" />
    </svg>
</a>

<a class=" mb-3" href="productos.php">PRODUCTOS</a>
<a class=" mb-3" href="tecnologia.php">TECNOLOGÍA</a>
<a class=" mb-3" href="contactos.php">CONTÁCTENOS</a>


<?php if (isset($usuario) && $usuario->getRol()==="admin" ): ?>
  <a class=" mb-3 btn bg-transparent border border-danger shadow d-flex align-items-center justify-content-center gap-2" href="admin_index.php">
    Admin
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
      <path d="M19.43 12.98c.04-.32.07-.65.07-.98s-.03-.66-.07-.98l2.11-1.65a.5.5 0 0 0 .11-.64l-2-3.46a.5.5 0 0 0-.6-.22l-2.49 1a7.03 7.03 0 0 0-1.69-.98l-.38-2.65A.5.5 0 0 0 14 2h-4a.5.5 0 0 0-.5.42l-.38 2.65a7.03 7.03 0 0 0-1.69.98l-2.49-1a.5.5 0 0 0-.6.22l-2 3.46a.5.5 0 0 0 .11.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98L2.4 14.63a.5.5 0 0 0-.11.64l2 3.46c.14.24.43.34.67.22l2.49-1c.5.38 1.05.72 1.69.98l.38 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.38-2.65a7.03 7.03 0 0 0 1.69-.98l2.49 1c.24.12.53.02.67-.22l2-3.46a.5.5 0 0 0-.11-.64l-2.11-1.65zM12 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z" />
    </svg>
  </a>
<?php endif ?>


<?php if (isset($usuario)): ?>
  <a class=" mb-3 btn bg-transparent border border-success shadow d-flex align-items-center justify-content-center gap-2" href="dashboard.php">
    Hola, <?php echo substr($usuario->getNombre(), 0, 5) . ".." ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
      <path fill-opacity=".8" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4 2H4a2 2 0 0 0-2 2v3h12v-3a2 2 0 0 0-2-2zm0 1a1 1 0 0 1 1 1H3a1 1 0 0 1 1-1h8z" />
      <path fill-rule="evenodd" d="M6 0a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h3zm0 1H3a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
    </svg>
  </a>
  <a class=" mb-3 btn bg-transparent border border-light d-flex align-items-center justify-content-center gap-2" href="index.php?cerrar=true">
    Salir
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
      <path fill-opacity=".8" d="M8.345 4.155h-3.75c-.415 0-.75.336-.75.75v15c0 .415.335.75.75.75h3.75v1.5h-3.75c-1.243 0-2.25-1.007-2.25-2.25v-15c0-1.242 1.007-2.25 2.25-2.25h3.75v1.5zm12.81 8.25l-7.06 7.061-1.061-1.06 5.25-5.25H6.843v-1.5h11.441l-5.251-5.25 1.06-1.061 7.061 7.06z"></path>
    </svg>
  </a>
<?php endif ?>

<?php if (!isset($usuario)): ?>
  <a class=" mb-3 btn bg-transparent border border-light d-flex align-items-center justify-content-center gap-2" href="registrar_usuario.php">
    Creá tu cuenta
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
      <path fill-opacity=".8" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4 2H4a2 2 0 0 0-2 2v3h12v-3a2 2 0 0 0-2-2zm0 1a1 1 0 0 1 1 1H3a1 1 0 0 1 1-1h8z" />
      <path fill-rule="evenodd" d="M6 0a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h3zm0 1H3a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
    </svg>
  </a>

  <a class=" mb-3 btn bg-transparent border border-light d-flex align-items-center justify-content-center gap-2" href="login.php#loginform">
    Ingresá
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
      <path fill-opacity=".8" d="M8.345 4.155h-3.75c-.415 0-.75.336-.75.75v15c0 .415.335.75.75.75h3.75v1.5h-3.75c-1.243 0-2.25-1.007-2.25-2.25v-15c0-1.242 1.007-2.25 2.25-2.25h3.75v1.5zm12.81 8.25l-7.06 7.061-1.061-1.06 5.25-5.25H6.843v-1.5h11.441l-5.251-5.25 1.06-1.061 7.061 7.06z"></path>
    </svg>

  </a>
<?php endif ?>