// flightplan.js
var plan = require('flightplan');

// configuration
plan.target('staging', {
  host: '172.104.169.95',
  username: 'zien-vps',
  agent: process.env.SSH_AUTH_SOCK
});

plan.remote(function(transport), {
  transport.exec('cd ~/kasir; git pull; yarn; yarn run dev; composer install;');
})

