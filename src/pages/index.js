import React, { useEffect, useState } from 'react';

import Meta from '@/components/Meta';
import About from '@/containers/About';
import Cta from '@/containers/Cta';
import Header from '@/containers/Header';
import Hero from '@/containers/Hero';
import LoadingPage from '@/containers/LoadingPage';
import Major from '@/containers/Major';
import Partner from '@/containers/Partner';
import Reward from '@/containers/Reward';
import TopBar from '@/containers/Topbar';
import { isBrowser } from '@/utils/utils';

export default function Home() {
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
      <Meta title="KingStudy" />
      <TopBar />
      <Header />
      <Hero />
      <Partner />
      <About />
      <Major />
      <Cta />
      <Reward />
      <LoadingPage done={done} percent={percent} />
    </div>
  );
}
