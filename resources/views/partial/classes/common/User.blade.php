<script>
    class User extends BaseClass {
        no_set = ['name'];

        before(form) {
			this.all_roles = @json(\App\Model\Common\Role::getForSelect());
            this.image = {};
        }

        after(form) {
            if (!this.id) {
                this.password = "123456@";
                this.password_confirm = "123456@";
            }
            this._birthday = form.birthday;
        }

        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        get birthday() {
            return dateGetter(this._birthday, 'YYYY-MM-DD', "DD/MM/YYYY");
        }

        set birthday(value) {
            this._birthday = dateSetter(value, "DD/MM/YYYY", 'YYYY-MM-DD');
        }

        get name ()  {
            if(this.surname && this.lastname) return this.surname + ' ' + this.lastname;

            return '';
        }

        set name (value) {

        }

        get submit_data() {
            let data = {
                name: this.name,
                surname: this.surname,
                lastname: this.lastname,
                email: this.email,
                password: this.password,
                password_confirm: this.password_confirm,
                roles: this.roles,
                status: this.status,
                birthday: this._birthday,
                nation: this.nation,
                address: this.address,
                phone: this.phone,
                skype: this.skype,
                facebook: this.facebook,
            }

            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);
            return data;
        }
    }
</script>
