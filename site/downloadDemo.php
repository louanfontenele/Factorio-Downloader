<?php
// site/downloadDemo.php
if (!$showDemo) return;

// Detect OS
$userOs = 'win64';
if (isset($_SERVER['HTTP_USER_AGENT'])) {
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if (stripos($ua, 'Mac') !== false || stripos($ua, 'Darwin') !== false) {
    $userOs = 'osx';
  } elseif (stripos($ua, 'Linux') !== false) {
    $userOs = 'linux64';
  }
}

// OS Icon para o botão grande do Demo:
$osIcon = 'fab fa-windows';
if ($userOs === 'osx') {
  $osIcon = 'fab fa-apple';
} elseif ($userOs === 'linux64') {
  $osIcon = 'fab fa-linux';
}
?>
<div class="flex-column mt0 panel type-demo">
  <h2 class="flex flex-space-between">
    <div><?php echo $demoSectionTitle; ?></div>
    <div class="download-version"><?php echo $demoLabel; ?> - <?php echo $currentDemoVersion; ?></div>
  </h2>
  <div class="panels2 flex-grow mh350">
    <div class="flex-column flex-grow">
      <div class="flex m0 flex-column flex-grow panel-inset-lighter">
        <p><?php echo $demoSectionDescription; ?></p>
        <!-- Big button usa OS detectado -->
        <div class="center margin-auto">
          <a href="download.php?ver=<?php echo urlencode($currentDemoVersion); ?>&build=demo&target=<?php echo $userOs; ?>"
             class="button-green download-button-type-demo download mt12">
            <div class="download-icon-container download-icon-type-demo-container">
              <i class="<?php echo $osIcon; ?>"></i> <?php echo $downloadDemoWindowsBig; ?>
            </div>
          </a>
        </div>
      </div>
      <!-- Painel de ícones -->
      <div class="panel-inset fs0 mb0 p4 text-right">
        <div class="flex flex-space-between flex-align-items-center">
          <div class="mr8 text-center">
            <strong><?php echo $demoLabel; ?></strong><br />
            <?php echo $currentDemoVersion; ?>
          </div>
          <div class="flex flex-space-between flex-align-items-center">
            <div class="flex-wrap inline-flex">
              <?php
              $platforms = [
                [
                  'target' => 'win64-manual',
                  'icon'   => 'fab fa-windows',
                  'label'  => '.zip',
                  'tooltip'=> $demoTooltipWinZip
                ],
                [
                  'target' => 'win64',
                  'icon'   => 'fab fa-windows',
                  'label'  => '',
                  'tooltip'=> $demoTooltipWin
                ],
                [
                  'target' => 'osx',
                  'icon'   => 'fab fa-apple',
                  'label'  => '',
                  'tooltip'=> $demoTooltipMac
                ],
                [
                  'target' => 'linux64',
                  'icon'   => 'fab fa-linux',
                  'label'  => '',
                  'tooltip'=> $demoTooltipLinux
                ],
              ];

              foreach ($platforms as $pf) {
                $highlightClass = ($pf['target'] === $userOs ||
                  ($pf['target'] === 'win64-manual' && $userOs === 'win64')) ? ' detected-os' : '';
                ?>
                <a href="download.php?ver=<?php echo urlencode($currentDemoVersion); ?>&build=demo&target=<?php echo $pf['target']; ?>"
                   class="button-green download-square download-button-type-demo<?php echo $highlightClass; ?>">
                  <div class="download-icon-container download-icon-type-demo-container">
                    <i class="<?php echo $pf['icon']; ?>"></i>
                    <?php if (!empty($pf['label'])): ?>
                      <div class="download-icon-dotzip"><?php echo $pf['label']; ?></div>
                    <?php endif; ?>
                  </div>
                </a>
                <div class="tooltip" role="tooltip">
                  <div class="panel-tooltip">
                    <p><?php echo htmlspecialchars($pf['tooltip']); ?></p>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
