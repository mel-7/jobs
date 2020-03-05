<template>
      <v-col cols="12" sm="6" md="4">
        <v-card id="loginform">
            <v-card-title class="px-5 pt-5 pb-0">Login</v-card-title>
            <v-card-text class="py-5 px-5">
                <v-form 
                    method="POST" 
                    action=""
                    ref="form"
                    v-model="valid"
                    lazy-validation>
                    <v-text-field
                        outlined
                        required
                        autocomplete="email"
                        id="email"
                        type="email"
                        name="email"
                        label="Email"
                        v-model="email"
                        :rules="emailrules"
                        value=""
                        error
                        error-messages=""
                        >
                        <!-- autofocus -->
                    </v-text-field>
                    <v-text-field
                        outlined
                        required
                        autocomplete="password"
                        id="password"
                        label="password"
                        type="password"
                        name="password"
                        v-model="password"
                        :rules="passwordrules"
                        error
                        error-messages=""
                        >
                    </v-text-field>
                        <!-- {{ old('remember') ? 'checked' : '' }} -->
                    <v-checkbox
                        type="checkbox"
                        name="remember"
                        id="remember"
                        label="Remember me"
                        color="primary"
                        class="mt-0">
                    </v-checkbox>
                    <v-btn 
                        width="100%"
                        height="55"
                        large
                        color="primary"
                        class="mb-5"
                        type="submit"
                        :disabled="!valid"
                        @click="validate"
                    >Login</v-btn>
                    <v-card-actions class="justify-center flex-column py-0">
                        <!-- <a href="{{ route('password.request') }}" class="pb-2">{{ __('Forgot your password?') }}</a>
                        <a href="{{ route('register') }}">{{ __('Create account') }}</a> -->
                    </v-card-actions>
                </v-form>
            </v-card-text>
        </v-card>
    </v-col>
</template>

<script>
export default {
    data: () => ({
        // {{ route('login') }}
        action: '',
        valid: true,
        email: '',
        emailrules: [
            value => !!value || 'Required',
            value => /.+@.+\..+/.test(value) || 'E-mail must be valid'
        ],
        password: '',
        passwordrules: [
            value => !!value || 'Required',
            value => (value && value.length > 8) || 'Password must be atleast 8 characters',
        ],
    }),
    methods: {
        validate () {
            if (this.$refs.form.validate()) {
                this.snackbar = true
            }
        }
    }
}
</script>