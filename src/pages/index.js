"use client"
import React from "react";
import Header from "@/containers/Header";
import Hero from "@/containers/Hero";

export default function Home() {
  return (
    <div
      className={`min-h-screen`}
    >
     <Header/>
      <Hero />
    </div>
  );
}
