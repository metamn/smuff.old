# ~/.profile: executed by the command interpreter for login shells.
# This file is not read by bash(1), if ~/.bash_profile or ~/.bash_login
# exists.
# see /usr/share/doc/bash/examples/startup-files for examples.
# the files are located in the bash-doc package.

# the default umask is set in /etc/profile; for setting the umask
# for ssh logins, install and configure the libpam-umask package.
#umask 022

# if running bash
if [ -n "$BASH_VERSION" ]; then
    # include .bashrc if it exists
    if [ -f "$HOME/.bashrc" ]; then
	. "$HOME/.bashrc"
    fi
fi

# set PATH so it includes user's private bin if it exists
if [ -d "$HOME/bin" ] ; then
    PATH="$HOME/bin:$PATH"
fi

alias update="sudo aptitude update"
alias install="sudo aptitude install"
alias upgrade="sudo aptitude safe-upgrade"
alias remove="sudo aptitude remove"

PS1='\[\033[0;35m\]\h\[\033[0;33m\] \w\[\033[00m\]: '


alias wp-upgrade="sudo chown -R www-data public_html/smuff.ro/public/"
alias wp-normal="sudo sudo chown -R cs public_html/smuff.ro/public/"

alias nx-restart="sudo /etc/init.d/nginx restart"
alias fc-restart="sudo /etc/init.d/php-fastcgi restart"

alias errt="tail -f public_html/smuff.ro/log/error.log"
alias errl="less public_html/smuff.ro/log/error.log"
alias errm="more public_html/smuff.ro/log/error.log"


export PATH=/var/lib/gems/1.8/bin:$PATH
