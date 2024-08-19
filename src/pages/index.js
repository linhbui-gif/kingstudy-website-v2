import https from 'https';

import React, { useEffect, useState } from 'react';

import Meta from '@/components/Meta';
import About from '@/containers/About';
import Cta from '@/containers/Cta';
import Feedback from '@/containers/Feedback';
import Hero from '@/containers/Hero';
import LoadingPage from '@/containers/LoadingPage';
import Major from '@/containers/Major';
import Partner from '@/containers/Partner';
import Reward from '@/containers/Reward';
import SchoolGrid from '@/containers/SchoolGrid';
import GuestLayout from '@/layouts/GuestLayout';
import { getSeoCommon } from '@/services/common';
import { isBrowser } from '@/utils/utils';

function Home({ seoConfig }) {
  const [state, setState] = useState(false);
  const [done, setDone] = useState(false);
  const [percent, setPercent] = useState(0);
  useEffect(() => {
    if (isBrowser()) {
      setState(true);
    }
  }, []);

  useEffect(() => {
    if (isBrowser()) {
      let timeoutId = undefined;
      document.fonts.ready.then(() => {
        timeoutId = window.setTimeout(() => {
          setDone(true);
        }, 2000);
      });
      return () => {
        window.clearTimeout(timeoutId);
      };
    }
    return () => {};
  });

  useEffect(() => {
    const simulatePageLoading = () => {
      let currentPercent = 0;
      const interval = setInterval(() => {
        currentPercent += 10;
        setPercent(currentPercent);
        if (currentPercent >= 100) {
          clearInterval(interval);
        }
      }, 100);
    };
    simulatePageLoading();
  }, []);
  return (
    <div className={`min-h-screen`} key={JSON.stringify(state)}>
      <Meta
        title={seoConfig?.meta_title}
        description={seoConfig?.meta_description}
        robots={seoConfig?.robots}
        thumbnail={seoConfig?.thumbnail}
      />
      <Hero />
      <Partner />
      <About />
      <Reward />
      <Major />
      <SchoolGrid />
      <Feedback />
      <Cta />
      <LoadingPage done={done} percent={percent} />
    </div>
  );
}
Home.getLayout = function (page) {
  return (
    <>
      <GuestLayout>{page}</GuestLayout>
    </>
  );
};
export async function getServerSideProps() {
  try {
    const agent = new https.Agent({
      rejectUnauthorized: false,
    });

    const responseSeo = await getSeoCommon(agent);
    const dataSeo = responseSeo.data;

    return {
      props: {
        seoConfig: dataSeo,
      },
    };
  } catch (error) {
    return {
      props: {
        seoConfig: null,
        error: error.message,
      },
    };
  }
}

export default Home;
