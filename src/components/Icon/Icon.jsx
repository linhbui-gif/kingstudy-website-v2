'use client';
import React from 'react';

import { EIconName } from './Icon.enum';
import Account from '@/components/Icon/Account';
import AmericanFlag from '@/components/Icon/AmericanFlag';
import ArrowRight from '@/components/Icon/ArrowRight';
import ArtDesign from '@/components/Icon/ArtDesign';
import Australlia_Flag from '@/components/Icon/AustralliaFlag';
import Business from '@/components/Icon/Business';
import Class from '@/components/Icon/Class';
import Compare from '@/components/Icon/Compare';
import ComputerScience from '@/components/Icon/ComputerScience';
import Education from '@/components/Icon/Education';
import Engineering from '@/components/Icon/Engineering';
import Exit from '@/components/Icon/Exit';
import Facebook from '@/components/Icon/Facebook';
import Favorite from '@/components/Icon/Favorite';
import Home from '@/components/Icon/Home';
import Idea from '@/components/Icon/Idea';
import Instagram from '@/components/Icon/Instagram';
import Ireland_Flag from '@/components/Icon/IrelandFlag';
import Law from '@/components/Icon/Law';
import Likedine from '@/components/Icon/Likedine';
import Loud from '@/components/Icon/Loud';
import Music from '@/components/Icon/Music';
import Partner from '@/components/Icon/Partner';
import Pharmacy from '@/components/Icon/Pharmacy';
import Scholarship from '@/components/Icon/ScholarshipResult';
import ScholarshipResult from '@/components/Icon/ScholarshipResult';
import Search from '@/components/Icon/Search';
import SocialWork from '@/components/Icon/SocialWork';
import Star from '@/components/Icon/Star';
import StudyAboard from '@/components/Icon/StudyAboard';
import Twitter from '@/components/Icon/Twitter';
import UK_Flag from '@/components/Icon/UKFlag';
import Vietnam_Flag from '@/components/Icon/VietnamFlag';
import Visa from '@/components/Icon/Visa';
const Icon = ({ name, color, className = '', onClick, width, height }) => {
  const renderIcon = () => {
    switch (name) {
      case EIconName.Account:
        return <Account />;
      case EIconName.ArtDesign:
        return <ArtDesign color={color} />;
      case EIconName.Arrow_Right:
        return <ArrowRight color={color} />;
      case EIconName.American_Flag:
        return <AmericanFlag />;
      case EIconName.Business:
        return <Business color={color} />;
      case EIconName.Class:
        return <Class color={color} />;
      case EIconName.Compare:
        return <Compare width={width} height={height} color={color} />;
      case EIconName.ComputerScience:
        return <ComputerScience color={color} />;
      case EIconName.Education:
        return <Education color={color} />;
      case EIconName.Engineering:
        return <Engineering color={color} />;
      case EIconName.Exit:
        return <Exit color={color} />;
      case EIconName.Facebook:
        return <Facebook color={color} />;
      case EIconName.Favorite:
        return <Favorite width={width} height={height} color={color} />;
      case EIconName.Twitter:
        return <Twitter color={color} />;
      case EIconName.Instagram:
        return <Instagram color={color} />;
      case EIconName.Likedine:
        return <Likedine color={color} />;
      case EIconName.Home:
        return <Home color={color} />;
      case EIconName.Idea:
        return <Idea color={color} />;
      case EIconName.UK_Flag:
        return <UK_Flag />;
      case EIconName.Australlia_Flag:
        return <Australlia_Flag />;
      case EIconName.Ireland_Flag:
        return <Ireland_Flag />;
      case EIconName.Vietnam_Flag:
        return <Vietnam_Flag />;
      case EIconName.Visa:
        return <Visa />;
      case EIconName.Partner:
        return <Partner color={color} />;
      case EIconName.Pharmacy:
        return <Pharmacy color={color} />;
      case EIconName.Scholarship:
        return <Scholarship color={color} />;
      case EIconName.Law:
        return <Law color={color} />;
      case EIconName.Loud:
        return <Loud color={color} />;
      case EIconName.Music:
        return <Music color={color} />;
      case EIconName.ScholarshipResult:
        return <ScholarshipResult color={color} />;
      case EIconName.SocialWork:
        return <SocialWork color={color} />;
      case EIconName.StudyAboard:
        return <StudyAboard color={color} />;
      case EIconName.Star:
        return <Star color={color} />;
      case EIconName.Search:
        return <Search color={color} />;
      default:
        break;
    }
  };
  return (
    <span
      className={`flex justify-center items-center ${className}`}
      onClick={onClick}
    >
      {renderIcon()}
    </span>
  );
};
export default Icon;
