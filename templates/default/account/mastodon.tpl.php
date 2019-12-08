<?php

use Idno\Core\Idno;

$baseURL = Idno::site()->config()->getDisplayURL();
$user = Idno::site()->session()->currentUser();
?>


<div class="col-md-offset-1 col-md-10">
    <?= $this->draw('account/menu') ?>
    <h1>Mastodon</h1>
    <?php
    if (empty($user->mastodon)) {
        ?>
        <p><?= \Idno\Core\Idno::site()->language()->_('1. Enter your Mastodon instance’s user details:') ?></p>
        <form action="<?= $baseURL ?>account/mastodon/" class="form-horizontal" method="post">
            <label for="username"><?= \Idno\Core\Idno::site()->language()->_('Mastodon full username') ?></label>
            <input type="email" class="form-control" name="username" id="username" placeholder="yourNick@mastodon.social" value="" />
            <label for="server"><?= \Idno\Core\Idno::site()->language()->_('Mastodon server name') ?></label>
            <input type="url" class="form-control" name="_server" id="server" placeholder="https://mastodon.social" value="" />
            <button type="submit" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Save') ?></button>
            <?= \Idno\Core\Idno::site()->actions()->signForm('/account/mastodon/') ?>
        </form>
        <?php
    } elseif(isset($_SESSION['mastodon_instance'])) {
      if (!empty($user->mastodon[$_SESSION['mastodon_instance']]['username']) && empty($user->mastodon[$_SESSION['mastodon_instance']]['bearer'])) {
        $account = $user->mastodon[$_SESSION['mastodon_instance']];
        $server = $account['server'];
        $config = \Idno\Core\Idno::site()->config()->config['mastodon'][$server];
        $authUrl = urldecode(\Idno\Core\Idno::site()->config()->config['mastodon'][$server][0]['auth_url']);
        ?>
        <p><?= \Idno\Core\Idno::site()->language()->_('2. Authorize with %s', [$server]) ?></p>
        <div class="control-group">
            <div class="controls-config">
                <div class="row">
                    <div class="col-md-7">
                        <p>
                            <?= \Idno\Core\Idno::site()->language()->_('When your account is connected to Mastodon. Public updates, pictures, and posts that you publish here can be cross-posted to %s.', [$server]) ?>
                        </p>

                        <div class="social">
                            <form action="<?= $authUrl ?>"
                                  class="form-horizontal" method="post">
                                <label for="username"><?= \Idno\Core\Idno::site()->language()->_('Mastodon full username') ?></label>
                                <input type="text" class="form-control disabled" name="username" disabled="disabled" id="username" placeholder="yourNick@mastodon.social" value="<?= $account['username'] // . '@' . $server // ? ?>" />
                                <label for="server"><?= \Idno\Core\Idno::site()->language()->_('Mastodon server name') ?></label>
                                <input type="text" class="form-control disabled" name="_server" disabled="disabled" id="server" placeholder="mastodon.social" value="<?= $server ?>" />
                                <button type="submit" class="btn btn-primary" disabled="disabled"><?= \Idno\Core\Idno::site()->language()->_('Save') ?></button>

                                <p>
                                    <input type="hidden" name="remove" value="1"/>
                                    <a href="<?= $authUrl ?>" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Connect to %s', [$server]) ?></a>

                                    <?= \Idno\Core\Idno::site()->actions()->signForm('/account/mastodon/') ?>
                                </p>
                            </form>
                            <form action="<?= $baseURL ?>account/mastodon/" class="form-horizontal" method=post>
                                <input type="hidden" name="remove" value="<?= (strstr($account['username'], '@')) ? $account['username'] : $account['username'] . '@' . $server ?>"/>
                                <button value="cancel" type="submit" name="cancel" class="btn btn-cancel"><?= \Idno\Core\Idno::site()->language()->_('Cancel') ?></button>
                                <?= \Idno\Core\Idno::site()->actions()->signForm('/account/mastodon/') ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
      }
    } else {
        ?>
        <div class="control-group">
            <div class="controls-config"><?php

?>
                <div class="row">
                    <div class="col-md-7">
                        <p>
                            <?= \Idno\Core\Idno::site()->language()->_('Your account is currently connected to these Mastodon instances. Public updates, pictures, and posts that you publish here can be cross-posted.') ?>
                        </p>

                        <?php
                           if($accounts = \Idno\Core\Idno::site()->syndication()->getServiceAccounts('mastodon')) {
                             foreach($accounts as $account) {
                               $tmp = explode('@', $account['username']);
                        ?>
                            <form action="<?= $baseURL ?>account/mastodon/"
                                  class="form-horizontal" method="post">
                              <div class="social">
                                <p>
                                    <input type="hidden" name="remove" value="<?= $account['username'] ?>"/>
                                    <button type="submit" class="connect mastodon connected"><i class="fa fa-user-circle"></i>
                                        <?= \Idno\Core\Idno::site()->language()->_('Disconnect %s', [$tmp[1]]) ?>
                                    </button>
                                    <?= \Idno\Core\Idno::site()->actions()->signForm('/account/mastodon/') ?>
                                </p>
                              </div>
                            </form>
                        <?php
                             }
                           }
        ?>
        <p><?= \Idno\Core\Idno::site()->language()->_('1. Enter your Mastodon instance’s user details:') ?></p>
        <form action="<?= $baseURL ?>account/mastodon/" class="form-horizontal" method="post">
            <label for="username"><?= \Idno\Core\Idno::site()->language()->_('Mastodon full username') ?></label>
            <input type="email" class="form-control" name="username" id="username" placeholder="yourNick@mastodon.social" value="" />
            <label for="server"><?= \Idno\Core\Idno::site()->language()->_('Mastodon server name') ?></label>
            <input type="url" class="form-control" name="_server" id="server" placeholder="https://mastodon.social" value="" />
            <button type="submit" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Save') ?></button>
            <?= \Idno\Core\Idno::site()->actions()->signForm('/account/mastodon/') ?>
        </form>
        <?php
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        \Idno\Core\Idno::site()->logging()->log(\Idno\Core\Idno::site()->language()->_('Mastodon debug : %s', [var_export($account, true)]));
    }
    ?>

<script>
$(document).ready(function() {

  $.KnownMastodon = {

  _m: function(event) {

    var s = $('#server');

    var t = event.target;

    var axis;
    var username = 'https://';
    if(t.value.indexOf('@') != -1) {
      axis = t.value.indexOf('@');
      username=username + t.value.substring(axis+1);
      s.val(username);
    }

  }

  }

  $('#username').change(function() {

    $.KnownMastodon._m(event);
    var t = event.target;
    console.log('change' + ':' + t.value);

  });

  $('#username').keyup(function() {

    $.KnownMastodon._m(event);
    var t = event.target;
    console.log('keyup' + ':' + t.value);

  });

  $('#username').mousedown(function() {

    $.KnownMastodon._m(event);
    var t = event.target;
    console.log('mousedown' + ':' + t.value);

  });

  $('#username').select(function() {

    $.KnownMastodon._m(event);
    var t = event.target;
    console.log('select' + ':' + t.value);

  });

});
</script>
</div>
