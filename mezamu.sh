case $1 in
	"build")
		echo "Creating database ....."
		php artisan migrate:fresh
		echo "Adding registers database ....."
		php artisan db:seed
	;;

    "loaddb")
    		echo "Adding registers database ....."
    		php artisan db:seed
    	;;
    *)
        echo 'Please enter a valid instruction'
    ;;
esac