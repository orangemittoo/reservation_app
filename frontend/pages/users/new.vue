<template>
  <form-layout>
    <h1>ユーザー登録</h1>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-text-field
        v-model="name"
        :counter="10"
        :rules="nameRules"
        label="名前"
        required
      ></v-text-field>

      <v-text-field
        v-model="email"
        :rules="emailRules"
        label="メールアドレス"
        required
      ></v-text-field>

      <v-text-field
        v-model="password"
        :rules="passwordRules"
        label="パスワード"
        type="password"
        required
      ></v-text-field>

      <v-text-field
        v-model="passwordConfirmation"
        :rules="passwordRules"
        type="password"
        label="パスワード（再入力）"
        required
      ></v-text-field>

      <v-row class="mt-5">
        <v-btn
          :disabled="!valid"
          color="success"
          class="mr-4"
          @click="submit"
        >
          登録
        </v-btn>

        <v-btn
          class="mr-4"
          @click="reset"
        >
          リセット
        </v-btn>
      </v-row>
    </v-form>
  </form-layout>
</template>

<script>
import FormLayout from '~/components/FormLayout.vue'
import createUser from "~/api/createUser";

export default {
  components: {
    FormLayout
  },
  data: () => ({
    valid: true,
    name: '',
    nameRules: [
      v => !!v || '名前を入力してください',
      v => (v && v.length <= 10) || '名前は10文字以下で入力してください',
    ],
    email: '',
    emailRules: [
      v => !!v || 'メールアドレスを入力してください',
      v => /.+@.+\..+/.test(v) || 'メールアドレスの形式が不正です',
    ],
    password: '',
    passwordConfirmation: '',
    passwordRules: [
      v => !!v || 'パスワードを入力してください',
      v => (v && v.length >= 8) || '名前は8文字以上で入力してください',
    ]
  }),

  methods: {
    validate () {
      this.$refs.form.validate()
    },
    reset () {
      this.$refs.form.reset()
    },
    async submit () {
      this.validate();
      await this.$nextTick()

      if (this.valid) {
        createUser({
          name: this.name,
          email: this.email,
          password: this.password,
          passwordConfirmation: this.passwordConfirmation
        }).then(() => {
          alert('登録完了');
        });
      }
    }
  },
}
</script>
