@include('admin.regent.RegentExperience')
<script>
    class RegentVi extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {
            this.experience = form.experience || [];
        }

        set experience(value) {
            this._experience = (value || []).map(val => new RegentExperience(val, this));
        }

        get experience() {
            return this._experience;
        }

        addExperience() {
            this._experience.push(new RegentExperience({}, this));
        }

        removeExperience(index) {
            this._experience.splice(index, 1);
        }

        get submit_data() {
            let data = {
                full_name: this.full_name,
                address: this.address,
                role: this.role,
                description: this.description,
                experience: this.experience.map(val => val.submit_data)

            }
            // data = jsonToFormData(data);
            // let image = $(`#${this.image.element_id}`).get(0).files[0];
            // if (image) data.append('image', image);

            return data;
        }
    }
</script>
