# Check to determine whether you're on a windows or linux/os-x host,
# later on we use this to launch ansible in the supported way (native or on your newly created box)
# source: https://stackoverflow.com/questions/2108727/which-in-ruby-checking-if-program-exists-in-path-from-ruby
def which(cmd)
    exts = ENV['PATHEXT'] ? ENV['PATHEXT'].split(';') : ['']
    ENV['PATH'].split(File::PATH_SEPARATOR).each do |path|
        exts.each { |ext|
            exe = File.join(path, "#{cmd}#{ext}")
            return exe if File.executable? exe
        }
    end
    return nil
end
Vagrant.configure("2") do |config|

    config.vm.provider :virtualbox do |v|
            v.name = "simple-tracker"
            v.customize [
                "modifyvm", :id,
                "--name", "simple-tracker",
                "--memory", 1024,
                "--natdnshostresolver1", "on",
                "--cpus", 1,
            ]
        end

    config.vm.box = "ubuntu/trusty64"
    
    config.vm.network :private_network, ip: "192.168.33.37"

    config.ssh.forward_agent = true

    ###########################################################################################
    # Ansible provisioning (you need to have ansible installed or run the windows provisioning)
    # Windows provisioning installs ansible in your box and runs it there
    ###########################################################################################

    if which('ansible-playbook')
        config.vm.provision "ansible" do |ansible|
            ansible.playbook = "ansible/playbook.yml"
            ansible.inventory_path = "ansible/inventories/dev"
            ansible.limit = 'all'
            ansible.extra_vars = {
                private_interface: "192.168.33.37",
                hostname: "simple-tracker"
            }
        end
    else
        config.vm.provision :shell, path: "ansible/windows.sh", args: ["simple-tracker"]
    end

    config.vm.synced_folder "./", "/vagrant", type: "nfs"
end
