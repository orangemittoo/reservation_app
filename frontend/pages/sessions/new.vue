<template>
  <form-layout>
    <h1>ログイン</h1>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >

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

      <v-row class="mt-5">
        <v-col cols="8">
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="submit"
          >
            ログイン
          </v-btn>
        </v-col>
        <v-col cols="4" class="text-right">
          <router-link to="/users/new">
            <v-btn
              :disabled="!valid"
              color="secondary"
              class="mr-4"
              @click="submit"
            >
              ユーザー登録
            </v-btn>
          </router-link>
        </v-col>
      </v-row>
    </v-form>
  </form-layout>
</template>

<script lang="ts">
import Vue from 'vue';
import FormLayout from '@/components/FormLayout.vue'
import login from "@/api/login";
import { saveToken } from "@/libs/token";

export default Vue.extend({
  layout: 'public',
  components: {
    FormLayout
  },
  data: () => ({
    valid: true,
    email: '',
    emailRules: [
      v => !!v || 'メールアドレスを入力してください',
      v => /.+@.+\..+/.test(v) || 'メールアドレスの形式が不正です',
    ],
    password: '',
    passwordConfirmation: '',
    passwordRules: [
      v => !!v || 'パスワードを入力してください'
    ]
  }),
  computed: {
    form(): any {
      return this.$refs.form;
    }
  },
  methods: {
    validate () {
      this.form.validate()
    },
    reset () {
      this.form.reset()
    },
    async submit () {
      this.validate();
      await this.$nextTick()

      if (this.valid) {
        login({
          email: this.email,
          password: this.password
        }).then((response: { user: {apiToken: string} }) => {
          saveToken(response.user.apiToken);
          this.$router.push('/');
        });
      }
    }
  },
});
</script>
