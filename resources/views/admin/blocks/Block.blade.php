<script>
    class Block extends BaseClass {
        no_set = [];

        before(form) {
            this.image = {};
        }

        after(form) {

        }


        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

		clearImage() {
			if (this.image) this.image.clear();
		}

        get submit_data() {
            let data = {
                name: this.name,
                title: this.title,
                title_en: this.title_en,
                body: this.body,
                body_en: this.body_en,
            }
            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);

            return data;
        }
    }
</script>
