import axios, { AxiosRequestConfig, AxiosError } from 'axios';
import humps from 'humps';
import { getToken } from "@/libs/token";

axios.interceptors.request.use(
  function (config) {
    if (process.browser && config.data && config.data instanceof FormData) {
      return config;
    }
    config.params = config.params && humps.decamelizeKeys(config.params);
    config.data = config.data && humps.decamelizeKeys(config.data);
    return config;
  },
  function (error) {
    return Promise.reject(error);
  }
);

axios.interceptors.response.use(
  (response) => {
    response.data = response.data && humps.camelizeKeys(response.data);
    return response;
  },
  (error) => {
    return Promise.reject(error);
  }
);


const requestDefaultConfig = {
  baseURL: 'http://localhost:8080/api',
  headers: {
    'Accept': 'application/json'
  }
};

const loader = (() => {
  let loadCounter = 0;
  return {
    status() {
      return loadCounter;
    },
    increment() {
      loadCounter = loadCounter + 1;
      return loadCounter;
    },
    decrement() {
      loadCounter = Math.max(loadCounter - 1, 0);
      return loadCounter;
    },
    completed() {
      return loadCounter === 0;
    },
    clear() {
      loadCounter = 0;
    }
  };
})();

export const errorHandler = (hideErrorMessage = false) => (
  err: AxiosError
) => {
  // const rootStore = getModule(root, store);
  let response = err.response || {
    data: {
      status: 'error',
      errors: { other: ['レスポンスエラーが発生しました。'] },
      raw: err
    }
  };
  try {
    if (!response.data) {
      response.data = {};
      response.data.errors = {
        other: ['サーバーエラーが発生しました。', 'errorCode: 101']
      };
    }
    if (response.data && !Object.keys(response.data.errors).length) {
      response.data.errors = {
        other: ['サーバーエラーが発生しました。', response.data.message]
      };
    }
  } catch (error) {
    response = {
      data: {
        status: 'error',
        errors: { other: ['エラーが発生しました。', error.message] },
        raw: error
      }
    };
  }

  loader.clear();
  // rootStore.hideLoader();

  if (!hideErrorMessage) {
    const err: string[] = [];
    for (const [key, value] of Object.entries(response.data.errors)) {
      err.push(value as string);
    }
    alert(err.join('\n'));
  }

  return Promise.reject(response);
};

type OptionType = {
  hideErrorMessage?: boolean;
  hideLoader?: boolean;
  baseURL?: string;
};

export default  (
  config: AxiosRequestConfig,
  options: OptionType = {}
) => {
  const requestConfig = {
    ...requestDefaultConfig,
    ...config,
    baseURL:
      options.baseURL == null ? requestDefaultConfig.baseURL : options.baseURL,
    headers: {
      'Authorization': 'Bearer ' + getToken()
    }
  };

  const isDisplayLoader = !options.hideLoader;
  if (isDisplayLoader) {
    loader.increment();
  }
  return axios(requestConfig)
    .then((res) => {
      if (isDisplayLoader) {
        loader.decrement();
        if (loader.completed()) {

        }
      }

      return Promise.resolve(res.data);
    })
    .catch(errorHandler(options.hideErrorMessage));
};
